#pragma once

#include <iostream>
using namespace std;


template < class ItemType>
void Merge(ItemType values[], int leftFirst, int leftLast, int rightFirst, int rightLast)
{
	ItemType tempArray[8];
	int index = leftFirst;
	int saveFirst = leftFirst;


	while ((leftFirst <= leftLast) &&
		(rightFirst <= rightLast))
	{
		if (values[leftFirst] < values[rightFirst])
		{
			tempArray[index] = values[leftFirst];
			leftFirst++;
		}
		else
		{
			tempArray[index] = values[rightFirst];
			rightFirst++;
		}
		index++;
	}
	while (leftFirst <= leftLast)
	{
		tempArray[index] = values[leftFirst];
		leftFirst++;
		index++;
	}
	while (rightFirst <= rightLast)
	{
		tempArray[index] = values[rightFirst];
		rightFirst++;
		index++;
	}
	for (index = saveFirst; index <= rightLast; index++)
	{
		values[index] = tempArray[index];
	}

	//print////////////////////
	cout << endl;
	for (int i = 0; i < 8; i++)
	{
		cout << values[i] << " ";
	}
	cout << endl;


}


template < class ItemType>
void MergeSort(ItemType values[], int first, int last)
{
	if (first < last)
	{
		int middle = (first + last) / 2;
		MergeSort(values, first, middle);
		MergeSort(values, middle + 1, last);
		Merge(values, first, middle, middle + 1, last);
	}
}