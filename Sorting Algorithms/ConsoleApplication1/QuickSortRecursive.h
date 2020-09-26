#pragma once

//template <class ItemType>
//void Split(ItemType values[],int first, int last,int& splitPt1,int& splitPt2);

template <class ItemType>
void Splitr(ItemType values[], int first, int last, int& splitPt1, int& splitPt2)
{
	::RecursiveQuickSortCount++;
	ItemType splitVal = values[(first + last) / 2], t;
	int i = first, j = last;

	cout << "SplitVal"<<splitVal<<endl;

	while (values[i] < splitVal)
	{
		::RecursiveQuickSortCount++;
		i++;
	}
	while (values[j] > splitVal)
	{
		::RecursiveQuickSortCount++;
		j--;
	}
	while (i < j)
	{
		::RecursiveQuickSortCount++;
		t = values[i];      values[i] = values[j];
		values[j] = t;
		i++;	j--;
		while (values[i] < splitVal)
		{
			::RecursiveQuickSortCount++;
			i++;
		}
		while (values[j] > splitVal)
		{
			::RecursiveQuickSortCount++;
			j--;
		}
	}
	if (i == j)
	{
		::RecursiveQuickSortCount++;
		i++;
		j--;
	}
	splitPt1 = i;
	splitPt2 = j;
}




template <class ItemType>
void QuickSort(ItemType values[], int first, int last)
{
	int splitPt1, splitPt2;
	if (first < last)
	{
		::RecursiveQuickSortCount++;
		Splitr(values, first, last, splitPt1, splitPt2);
		//values[first]..values[splitPt2]<= splitVal
		//values[splitPt1]..values[last]>= splitVal
		QuickSort(values, first, splitPt2);
		QuickSort(values, splitPt1, last);
		
		
		
		//print////////////////////
		cout << endl;
		for (int i = 0; i < last+1; i++)
		{
			cout << values[i] << " ";
		}
		cout << endl;
		//print////////////////////
	}
}



