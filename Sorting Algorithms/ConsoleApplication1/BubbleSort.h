#pragma once
#include <iostream>
using namespace std;

template < class ItemType>
void BubbleUp(ItemType values[], int startIndex, int endIndex, bool& sorted)
{
	sorted = true;
	for (int index = endIndex; index > startIndex; index--)
	{
		//::bubblecount++;
		if (values[index] < values[index - 1])
		{
			//::bubblecount++;
			Swap(values[index], values[index - 1]);
			cout << "Swap" << endl;
			sorted = false;
		}
	}
}

template < class ItemType>
void BubbleSort(ItemType values[], int numValues)
{
	int current = 0;
	bool sorted = false;
	while (current < numValues - 1 && !sorted)
	{
		//::bubblecount++;
		BubbleUp(values, current, numValues - 1, sorted);
		
		//print////////////////////
		cout << endl;
		for (int i = 0; i < numValues; i++)
		{
			cout << values[i]<<" ";
		}
		cout << endl;




		current++;
	}
}



