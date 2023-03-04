import os

import tflearn
import speech_data as data

# Simple speaker recognition demo, with 99% accuracy in under a minute ( on digits sample )

# | Adam | epoch: 030 | loss: 0.05330 - acc: 0.9966 -- iter: 0000/1000
# 'predicted speaker for 9_Vicki_260 : result = ', 'Vicki'
import tensorflow as tf
#import speechdata as data
print("You are using tensorflow version "+ tf.__version__) #+" tflearn version "+ tflearn.version)
if tf.__version__ >= '0.12' and os.name == 'nt':
	print("sorry, tflearn is not ported to tensorflow 0.12 on windows yet!(?)")
	quit() # why? works on Mac?

DATA_DIR = 'speechdata/'

pcm_path = "speechdata/spoken_numbers_pcm/"
path = pcm_path
CHUNK = 4096
test_fraction=0.1

from enum import Enum
class Target(Enum):  # labels
	digits=1
	speaker=2
	words_per_minute=3
	word_phonemes=4
	word = 5  # int vector as opposed to binary hotword
	sentence=6
	sentiment=7
	first_letter=8
	hotword = 9
	# test_word=9 # use 5 even for speaker etc


num_characters = 32
# num_characters=60 #  only one case, Including numbers
# num_characters=128 #
# num_characters=256 #  including special characters
# offset=0  # 1:1 mapping ++
# offset=32 # starting with ' ' space
# offset=48 # starting with  numbers
offset = 64  # starting with characters
max_word_length = 20
terminal_symbol = 0


def mfcc_batch_generator(batch_size=10, source=Source.DIGIT_WAVES, target=Target.digits):
	maybe_download(source, DATA_DIR)
	if target == Target.speaker: speakers = get_speakers()
	batch_features = []
	labels = []
	files = os.listdir(path)
	while True:
		print("loaded batch of %d files" % len(files))
		shuffle(files)
		for file in files:
			if not file.endswith(".wav"): continue
			wave, sr = librosa.load(path+file, mono=True)
			mfcc = librosa.feature.mfcc(wave, sr)
			if target==Target.speaker: label=one_hot_from_item(speaker(file), speakers)
			elif target==Target.digits:  label=dense_to_one_hot(int(file[0]),10)
			elif target==Target.first_letter:  label=dense_to_one_hot((ord(file[0]) - 48) % 32,32)
			elif target == Target.hotword: label = one_hot_word(file, pad_to=max_word_length)  #
			elif target == Target.word: label=string_to_int_word(file, pad_to=max_word_length)
				# label = file  # sparse_labels(file, pad_to=20)  # max_output_length
			else: raise Exception("todo : labels for Target!")
			labels.append(label)
			# print(np.array(mfcc).shape)
			mfcc=np.pad(mfcc,((0,0),(0,80-len(mfcc[0]))), mode='constant', constant_values=0)
			batch_features.append(np.array(mfcc))
			if len(batch_features) >= batch_size:
				# if target == Target.word:  labels = sparse_labels(labels)
				# labels=np.array(labels)
				# print(np.array(batch_features).shape)
				# yield np.array(batch_features), labels
				# print(np.array(labels).shape) # why (64,) instead of (64, 15, 32)? OK IFF dim_1==const (20)
				yield batch_features, labels  # basic_rnn_seq2seq inputs must be a sequence
				batch_features = []  # Reset for next batch
				labels = []

				
speakers = data.get_speakers()
number_classes=len(speakers)
print("speakers",speakers)

batch=data.wave_batch_generator(batch_size=1000, source=data.Source.DIGIT_WAVES, target=data.Target.speaker)
X,Y=next(batch)


# Classification
tflearn.init_graph(num_cores=8, gpu_memory_fraction=0.5)

net = tflearn.input_data(shape=[None, 8192]) #Two wave chunks
net = tflearn.fully_connected(net, 64)
net = tflearn.dropout(net, 0.5)
net = tflearn.fully_connected(net, number_classes, activation='softmax')
net = tflearn.regression(net, optimizer='adam', loss='categorical_crossentropy')

model = tflearn.DNN(net)
model.fit(X, Y, n_epoch=100, show_metric=True, snapshot_step=100)

# demo_file = "8_Vicki_260.wav"
demo_file = "8_Bruce_260.wav"
demo=data.load_wav_file(data.path + demo_file)
result=model.predict([demo])
result=data.one_hot_to_item(result,speakers)
print("predicted speaker for %s : result = %s "%(demo_file,result)) # ~ 97% correct
