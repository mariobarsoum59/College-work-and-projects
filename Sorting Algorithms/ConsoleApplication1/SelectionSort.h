#pragma once
#include <iostream>
using namespace std;

template <class ItemType>
void Swap(ItemType& item1, ItemType& item2)
{
	ItemType tempItem;  // temporary holding area for swap

	tempItem = item1;
	item1 = item2;
	item2 = tempItem;
}

template  <class ItemType>
int minIndex(ItemType values[], int startIndex, int endIndex)
{
	int indexOfMin = startIndex;
	for (int index = indexOfMin + 1; index <= endIndex; index++)
	{
		 //::count++;
		if (values[index] < values[indexOfMin])
		{
			//::count++;
			indexOfMin = index;
		}
	}
	cout << "index of smallest val= " << indexOfMin<<endl;
	return indexOfMin;
}




template <class ItemType>
void SelectionSort(ItemType values[], int numValues)
{
	int endIndex = numValues - 1;
	for (int current = 0; current < endIndex; current++)
	{
		//::count++;
		Swap(values[current], values[minIndex(values, current, endIndex)]);
		


		//print////////////////////
		cout << endl;
		for (int i = 0; i < numValues; i++)
		{
			cout << values[i]<<" ";
		}
		cout << endl;
		//print////////////////////
	}
}



