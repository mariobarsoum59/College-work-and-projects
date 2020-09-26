#pragma once
#include "QueType.h"

template<class ItemType>
void RadixSort(ItemType values[], int numValues, int numPositions, int radix)
{
	QueType<int> queues[10];
	int whichQueue;

	for (int position = 1; position <= numPositions; position++)
	{
		for (int counter = 0; counter < numValues; counter++)
		{
			whichQueue = values[counter].SubKey(position);
			queues[whichQueue].Enqueue(values[counter]);
		}
		CollectQueues(values, queues, radix);
	}
}


template<class ItemType>
void CollectQueues(ItemType values[], QueType<ItemType> queues[], int radix)
{
	int index = 0;
	ItemType item;

	for (int counter = 0; counter < radix; counter++)
	{
		while (!queues[counter].IsEmpty())
		{
			queues[counter].Dequeue(item);
			values[index] = item;
			index++;
		}
	}
}