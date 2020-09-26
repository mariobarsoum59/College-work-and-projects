#pragma once
#include <iostream>
#include <iomanip>
using namespace std;
int BinarySearchCount = 0;


//template <class ListType>
void BinarySearch(int arr[], int item, bool found)
{
	int midPoint;
	int first = 0;
	int last = 22 -1;
	bool moreToSearch = first <= last;
	found = false;

	while (moreToSearch && !found)
	{
		BinarySearchCount++;
		midPoint = (first + last) / 2;
			if (item < arr[midPoint])
			{
				BinarySearchCount++;
				last = midPoint -1;
				moreToSearch = first <= last;
			}
			else if (item > arr[midPoint])
			{
				BinarySearchCount++;
				first = midPoint + 1;
				moreToSearch = first <= last;
			}
			else
			{
				BinarySearchCount++;
				item = arr[midPoint];
				found = true;
			}
	}
}



//int REBinarySearch(int arr[], int item, bool& found)
///* Post:If found the function returns to position of item in list.info.
//Otherwise it returns –1.	*/
//{
//	int first = 0;
//	int last = 22-1;
//	int midPoint;
//	found = false;
//
//	while (first <= last)
//	{
//		BinarySearchCount++;
//		midPoint = (first + last) / 2;
//		if (item == arr[midPoint])
//		{
//			BinarySearchCount++;
//			found = true;
//			return midPoint;
//		}
//		else if (item > arr[midPoint])
//		{
//			BinarySearchCount++;
//			first = midPoint + 1;
//		}
//		else
//		{
//			BinarySearchCount++;
//			last = midPoint - 1;
//		}
//
//	}
//	return -1;
//}


////template <class ItemType>
//int  ForgetfulBinarySearch(int arr[],int item, bool& found)
//	/* Post:If found the function returns to position of item in list.info. Otherwise it returns –1.	*/
//{
//	int first = 0;
//	int last = ::MAX_ITEMS – 1;
//	int midPoint;
//	found = false;
//	while (first < last)
//	{
//		midPoint = (first + last) / 2;
//		if (item > arr[midPoint])
//			first = midPoint + 1;
//		else
//			last = midPoint;
//	}
//	if (last == -1)
//		return –1;
//	else if (item == arr[first])
//	{
//		found = true;
//		return first;
//	}
//	else
//		return –1;
//}




//int binarySearch(int arr[], int l, int r, int x)
//{
//	
//	if (r >= l)
//	{
//		BinarySearchCount++;
//		int mid = l + (r - l) / 2;
//
//		// If the element is present at the middle 
//		// itself 
//		if (arr[mid] == x)
//		{
//			BinarySearchCount++;
//			return mid;
//		}
//		// If element is smaller than mid, then 
//		// it can only be present in left subarray 
//		if (arr[mid] > x)
//		{
//			BinarySearchCount++;
//			return binarySearch(arr, l, mid - 1, x);
//		}
//		// Else the element can only be present 
//		// in right subarray 
//		else
//		{
//
//			BinarySearchCount++;
//			return binarySearch(arr, mid + 1, r, x);
//			
//
//		}
//	}
//	// We reach here when element is not 
//	// present in array 
//	
//	cout << BinarySearchCount;
//	return -1;
//
//}