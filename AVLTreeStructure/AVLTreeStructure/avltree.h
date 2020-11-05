#pragma once
#include <iostream>
#include <iomanip>


using namespace std;

enum BF { LH, EH, RH };

struct node {
	string value;
	node* left;
	node* right;
	BF bf;
};

class avltree {
public:
	avltree();
	~avltree();
	//call the recursive functions


	void InsertItem(string item);
	void inorder_print();	//LVR
	void searchItem(string key, bool found);
	void DeleteItem(string item);






private:

	//recursive functions

	void Insert(node*& tree, string item, bool& taller);
	void inorder_print(node* leaf);
	void RightBalance(node*& tree, bool& taller);
	void RotateRight(node*& tree);
	void RotateLeft(node*& tree);
	void LeftBalance(node*& tree, bool& taller);
	void search(node* leaf, string key, bool found);
	void Delete(node*& tree, string item, bool& shorter);
	void DeleteNode(node*& tree, bool& shorter);
	void GetPredecessor(node* tree, string& data);
	void DelRightBalance(node*& tree, bool& shorter);
	void DelLeftBalance(node*& tree, bool& shorter);

	node* root;

};


avltree::avltree() {
	root = NULL;

}

avltree::~avltree() {

}



void avltree::InsertItem(string item)
// Calls recursive function Insert to insert item into tree.
{
	bool taller = false;
	Insert(root, item, taller);
}


void avltree::Insert(node*& tree, string item, bool& taller)
// Inserts item into tree.				 
// Post:	item is in tree; search property is maintained.
{

	if (tree == NULL)
	{	// Insertion place found.
		tree = new node;
		tree->left = NULL;
		tree->right = NULL;
		tree->value = item;
		tree->bf = EH;

		taller = true;
	}
	else if (item == tree->value)
		cout << "Duplicate key is not allowed in AVL tree." << endl;
	else if (item < tree->value)
	{
		Insert(tree->left, item, taller);  		// Insert into left subtree				
		if (taller)
			switch (tree->bf)
			{
			case LH: LeftBalance(tree, taller);
				break;
			case EH: tree->bf = LH;
				break;
			case RH: tree->bf = EH;
				taller = false;
				break;
			}
	}
	else {
		Insert(tree->right, item, taller);   		// Insert into right subtree				
		if (taller)
			switch (tree->bf)
			{
			case RH:
				RightBalance(tree, taller);
				break;
			case EH:
				tree->bf = RH;
				break;
			case LH:
				tree->bf = EH;
				taller = false;
				break;
			}
	}
}



void avltree::RightBalance(node*& tree, bool& taller)
{
	node* rs = tree->right;
	node* ls;

	switch (rs->bf)
	{
	case RH:
		tree->bf = rs->bf = EH;
		RotateLeft(tree);
		taller = false;
		break;
	case EH:
		cout << "Tree already balanced " << endl;
		break;
	case LH:
		ls = rs->left;
		switch (ls->bf)
		{
		case RH:
			tree->bf = LH;
			rs->bf = EH;
			break;
		case EH:
			tree->bf = rs->bf = EH;
			break;
		case LH:
			tree->bf = EH;
			rs->bf = RH;
			break;
		}
		ls->bf = EH;
		RotateRight(tree->right);
		RotateLeft(tree);
		taller = false;
	}

}



void avltree::LeftBalance(node*& tree, bool& taller)
{
	node* ls = tree->left;
	node* rs;

	switch (ls->bf)
	{
	case LH:
		tree->bf = ls->bf = EH;
		RotateRight(tree);
		taller = false;
		break;
	case EH:
		cout << "Tree already balanced " << endl;
		break;
	case RH:
		rs = ls->right;
		switch (rs->bf)
		{
		case LH:
			tree->bf = RH;
			ls->bf = EH;
			break;
		case EH:
			tree->bf = ls->bf = EH;
			break;
		case RH:
			tree->bf = EH;
			ls->bf = LH;
			break;
		}
		rs->bf = EH;
		RotateLeft(tree->left);
		RotateRight(tree);
		taller = false;
	}

}



void avltree::RotateRight(node*& tree)
{
	node* ls;
	if (tree == NULL)
		cout << "It is impossible to rotate an empty tree in RotateRight"
		<< endl;
	else if (tree->left == NULL)
		cout << "It is impossible to make an empty subtree the root in RotateRight" << endl;
	else
	{
		ls = tree->left;
		tree->left = ls->right;
		ls->right = tree;
		tree = ls;
	}
}



void avltree::RotateLeft(node*& tree)
{
	node* rs;
	if (tree == NULL)
		cerr << "It is impossible to rotate an empty tree in RotateLeft"
		<< endl;
	else if (tree->right == NULL)
		cerr << "It is impossible to make an empty subtree the root in RotateLeft" << endl;
	else
	{
		rs = tree->right;
		tree->right = rs->left;
		rs->left = tree;
		tree = rs;
	}
}



void avltree::inorder_print() {
	inorder_print(root);
	cout << "\n";
}

void avltree::inorder_print(node* leaf) {
	if (leaf != NULL)
	{
		inorder_print(leaf->left);
		cout << endl;
		cout << leaf->value << " \t ";
		if (leaf->left == NULL)
		{
			cout << "Null" << "\t";
		}
		else 
		{
			cout << leaf->left->value << "\t";
		}

		if (leaf->right == NULL)
		{
			cout << "Null" << "\t";
		}
		else
		{
			cout << leaf->right->value << "\t";
		}
		if (leaf->bf == 0)
		{
			cout << "LH";
		}
		else if (leaf->bf == 1)
		{
			cout << "EH";
		}
		else if (leaf->bf == 2)
		{
			cout << "RH";
		}
		
		inorder_print(leaf->right);
	}
}


void avltree::searchItem(string key, bool found)
{
	return search(root, key, found);

}

void avltree::search(node* leaf, string key, bool found)
{
	if (leaf == NULL)
	{
		found = false;
		cout << "Item Not found" << endl;
	}


	else if (key < leaf->value)// Search left subtree.
		search(leaf->left, key, found);
	else if (key > leaf->value)// Search right subtree.
		search(leaf->right, key, found);
	else
	{
		// item is found.
		key = leaf->value;
		found = true;
		cout << "Found Item" << endl;
	}

}

void avltree::DeleteItem(string item)
// Calls recursive function Delete to delete item from tree.
{
	bool shorter;
	Delete(root, item, shorter);
}

void avltree::Delete(node*& tree, string item, bool& shorter)
{
	if (tree != NULL)
	{
		if (item < tree->value)
		{
			Delete(tree->left, item, shorter);
			// Look in left subtree.
			if (shorter)
				switch (tree->bf)
				{
				case LH: tree->bf = EH; break;
				case EH: tree->bf = RH; shorter = false;
					break;
				case RH: DelRightBalance(tree, shorter);
				} // END SWITCH	
		}
		else if (item > tree->value)
		{
			Delete(tree->right, item, shorter);
			// Look in right subtree.
			if (shorter)
				switch (tree->bf)
				{
				case LH: DelLeftBalance(tree, shorter);
				break;				case EH: tree->bf = LH; shorter = false; 							break;
				case RH: tree->bf = EH; break;
				} // END SWITCH
		}
		else
			DeleteNode(tree, shorter);
		// Node found; call DeleteNode.
	} // END if (tree != NULL)
	else
	{
		cout << "\nNOTE: " << item
			<< " not in the tree so cannot be deleted.";
	}
}

void avltree::DeleteNode(node*& tree, bool& shorter)
// Delete the node pointed to by tree.
// Post: The user's data in the node pointed to by tree is no longer in the tree. // If tree is a leaf node or has only one non-NULL child pointer, the node 
// pointed to by tree is deleted; otherwise, the user's data is replaced by its
// logical predecessor and the predecessor's node is deleted.
{
	string data;	
	node* tempPtr;
	tempPtr = tree;
	if (tree->left == NULL)
	{
		tree = tree->right;
		delete tempPtr;
		shorter = true;
	}
	else if (tree->right == NULL)
	{
		tree = tree->left;
		delete tempPtr;
		shorter = true;
	}
	else
	{
		GetPredecessor(tree, data);
		tree->value = data;
		Delete(tree->left, data, shorter);
		// Delete the predecessor node
		if (shorter)
			switch (tree->bf)
			{
			case LH: tree->bf = EH; break;
			case EH: tree->bf = RH; shorter = false;
				break;
			case RH: DelRightBalance(tree, shorter);
			}
	}
}


void avltree::GetPredecessor(node* tree, string& data)
// Sets data to the info member of the right-most node in tree.
{
	tree = tree->left;
	while (tree->right != NULL)
		tree = tree->right;
	data = tree->value;
}


void avltree::DelRightBalance(node*& tree, bool& shorter)
{
	node* rs = tree->right;
	node* ls;
	switch (rs->bf)
	{
	case RH:	tree->bf = rs->bf = EH;
		RotateLeft(tree);
		shorter = true; break;
	case EH:	tree->bf = RH;
		rs->bf = LH;
		RotateLeft(tree);
		shorter = false; break;
	case LH:	ls = rs->left;
		switch (ls->bf)
		{
		case RH:	tree->bf = LH;
			rs->bf = EH; break;
		case EH:	tree->bf = rs->bf = EH;
			break;
		case LH:	tree->bf = EH;
			rs->bf = RH; break;
		} // END SWITCH

		ls->bf = EH;
		RotateRight(tree->right);
		RotateLeft(tree);
		shorter = true;
	}
}

void avltree::DelLeftBalance(node*& tree, bool& shorter)
{
	node* ls = tree->left;
	node* rs;
	switch (ls->bf)
	{
	case LH:	tree->bf = ls->bf = EH;
		RotateRight(tree);
		shorter = true; break;
	case EH:	tree->bf = LH;
		ls->bf = RH;
		RotateRight(tree);
		shorter = false; break;
	case RH:	rs = ls->right;
		switch (rs->bf)
		{
		case LH:	tree->bf = RH;
			ls->bf = EH; break;
		case EH:	tree->bf = ls->bf = EH;
			break;
		case RH:	tree->bf = EH;
			ls->bf = LH; break;
		} // END SWITCH
		rs->bf = EH;
		RotateLeft(tree->left);
		RotateRight(tree);
		shorter = true;
	}
}
