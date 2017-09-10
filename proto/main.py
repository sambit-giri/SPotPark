import numpy as np
import sys

block_NW = np.load('block_NW.npy')
block_NE = np.load('block_NE.npy')
block_SW = np.load('block_SW.npy')
block_SE = np.load('block_SE.npy')

block_name = sys.argv[1]

if black_name=='NW':
	spot = np.argwhere(block_NW==0)
	if spot.size ==0: spot_ = 0
	else: 
		spot_ = spot[0]+1
		block_NW[spot[0]] = 1
elif black_name=='NE':
	spot = np.argwhere(block_NE==0)
	if spot.size ==0: spot_ = 0
	else: 
		spot_ = spot[0]+1
		block_NE[spot[0]] = 1
elif black_name=='SW':
	spot = np.argwhere(block_SW==0)
	if spot.size ==0: spot_ = 0
	else: 
		spot_ = spot[0]+1
		block_SW[spot[0]] = 1
elif black_name=='SE':
	spot = np.argwhere(block_NE==0)
	if spot.size ==0: spot_ = 0
	else: 
		spot_ = spot[0]+1
		block_SE[spot[0]] = 1

np.save('block_NW.npy', block_NW)
np.save('block_NE.npy', block_NE)
np.save('block_SW.npy', block_SW)
np.save('block_SE.npy', block_SE)

print spot_




