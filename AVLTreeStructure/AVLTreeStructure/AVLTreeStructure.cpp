// AVLTreeStructure.cpp : This file contains the 'main' function. Program execution begins and ends there.
//

#include <iostream>
#include <iomanip>
#include "avltree.h"
#include "avltree.h"




using namespace std;

int main()
{
	int option;
	avltree tree;



	do
	{
		string a;
		string item;
		cout << endl << endl;
		cout << "\t 1. Add Item" << endl;
		cout << "\t 2. Inorder Print" << endl;
		cout << "\t 3. Search" << endl;
		cout << "\t 4. Delete Item" << endl;
		cout << "\t -1. Exit" << endl;

		cin >> option;

		switch (option)
		{
		case 1:
			cout << "Enter String To Add" << endl;
			cin >> a;
			tree.InsertItem(a);

			break;

		case 2:
			cout << "Inorder Print" << endl << endl;
			cout << "Node \t L \t R\t BF" << endl;
			tree.inorder_print();
			break;

		case 3:
			cout << "Enter String to Search for: ";
			cin >> item;
			tree.searchItem(item, 0);
			break;

		case 4:
			cout << "Enter Item You wish to remove from Tree" << endl;
			cin >> item;
			tree.DeleteItem(item);
			break;


			
			


		}



	} while (option != -1);
	

	
	

}

