// ConsoleApplication1.cpp : This file contains the 'main' function. Program execution begins and ends there.
//
#include <fstream>
#include <iostream>
#include <iomanip>

#include "SelectionSort.h"
#include "BubbleSort.h"
#include "InsertionSort.h"
#include "QuickSortRecursive.h"
#include "QuickSortI.h"
#include"REBinarySearch.h"
#include "QueType.h"
#include "RadixSort.h"
#include "MergeSort.h"

using namespace std;


//const int MAX_ITEMS = 22;
//
//template <class ItemType>
//struct ListType
//{
//	int length;
//	ItemType info[MAX_ITEMS];
//};

int count = 0;
int bubblecount = 0;
int Insertioncount = 0;
int RecursiveQuickSortCount = 0;
int QuickSortIteratveCount = 0;



int main()
{

//	ListType<int> list;
//
//	list.length = 0;
//
//	
//
//// Get length of file 
////************************************************************
//	/*string s;
//	int sTotal=0;
//
//	ifstream in;
//	in.open("grades.txt");
//
//	while (!in.eof()) 
//	{
//		getline(in, s);
//		sTotal++;
//	}
//
//	cout << sTotal;*/
//
////************************************************************
//	int arr[22];
//	int pos = 0;
//	char cNum[10];
//
////Read from file into array.
////*************************************************************
//	ifstream myfile("grades.txt");
//	if (myfile.is_open())
//	{
//		while (!myfile.eof())
//		{
//			//myfile >> arr[pos++]; //Reading in one line sepearated by spaces or one number per line
//
///////////////////////////////////////////////////////-reading from a txt separated by commas
//			myfile.getline(cNum, 256, ',');
//			arr[pos] = atoi(cNum);
//			pos++;
//		///////////////////////////////////////////
//		
//		
//		}
//		myfile.close();
//	}
//
//	else cout << "Unable to open file";
//
//	for (int i = 0; i < 22; i++)
//	{
//		cout << arr[i]<<" ";
//	}
//	
////***************************************************************
//	//for (int i = 0; i < MAX_ITEMS; i++)
//	//{
//	//	cin >> list.info[i];
//	//	list.length++;
//	//}
//



	const int MAX_ITEMS = 8;

	int arr[8] = { 8, 22, 7, 9, 31, 19, 5, 13 };

	cout << "\n Before Sort " << endl;
	for (int i = 0; i < MAX_ITEMS; i++)
	{
		cout << arr[i] << ' ';
	}
	cout << endl;
	cout << "-------------------------------------------------------";
	// Insert call to a sort function of your choice

	
	
	//SelectionSort(arr, MAX_ITEMS);
	BubbleSort(arr, MAX_ITEMS);
	//Insertionsort(arr,MAX_ITEMS);
	//QuickSort(arr, 0, MAX_ITEMS-1);
	//MergeSort(arr, 0, MAX_ITEMS - 1);
	//DosntWork//RadixSort(arr, MAX_ITEMS, 2, 10);

	//int x = ForgetfulBinarySearch(arr, 75, false);
	
	//BinarySearch(arr, 75, false);
	
	//////QuickSortI(arr, 0, MAX_ITEMS-1);



	
	cout << "-------------------------------------------------------" << endl;
	cout << endl << "\n After Sort " << endl;
	for (int i = 0; i < MAX_ITEMS; i++)
	{
		cout << arr[i] << ' ';
	}
	cout << endl;
	cout << endl;
















	//cout << "\n\nThe comparison count For Selection sort is : " <<::count << endl;
	//cout << "\n\nThe comparison count For Bubble sort is : " << ::bubblecount << endl;
	//cout << "\n\nThe comparison count For Insertion sort is : " << ::Insertioncount << endl;
	//cout << "\n\nThe comparison count For the Recursive Quicksort is : " << ::RecursiveQuickSortCount << endl;
	//cout << "\n\nThe comparison count For the Iterative Quicksort is : " << ::QuickSortIteratveCount << endl;
	//cout << "\n\nThe comparison count For the Binary Search is : " << ::BinarySearchCount << endl;
	return 0;
}

