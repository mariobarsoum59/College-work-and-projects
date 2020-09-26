#pragma once
#pragma once
#include <iostream>;
#include <iomanip>;
using namespace std;

template <class ItemType>
struct NodeType;

template <class ItemType>
class QueType
{
public:
	QueType();
	~QueType();
	void MakeEmpty();
	bool IsEmpty() const;
	bool IsFull() const;
	void Enqueue(ItemType newItem);
	void Dequeue(ItemType& item);
	void PrintQue();
	bool search(ItemType& item);
	int Size();
	int Total();
private:
	NodeType<ItemType>* qFront;
	NodeType<ItemType>* qRear;
};
//====================================

template <class ItemType>
struct NodeType
{
	ItemType info;
	NodeType* next;

};

template <class ItemType>
QueType<ItemType>::QueType()
{
	qFront = NULL;
	qRear = NULL;

}

template <class ItemType>
QueType<ItemType>::~QueType()
{
	MakeEmpty();
}


template <class ItemType>
void QueType<ItemType>::MakeEmpty()
{
	NodeType<ItemType>* tempPtr;

	while (qFront != NULL)
	{
		tempPtr = qFront;
		qFront = qFront->next;
		delete tempPtr;
	}
	qRear = NULL;
}

template <class ItemType>
bool QueType<ItemType>::IsFull() const
{
	NodeType<ItemType>* ptr;
	ptr = new NodeType<ItemType>;
	if (ptr == NULL)
		return true;
	else
	{
		delete ptr;
		return false;
	}
}

template <class ItemType>
bool QueType<ItemType>::IsEmpty() const
{
	return (qFront == NULL);
}


template <class ItemType>
void QueType<ItemType>::Enqueue(ItemType newItem)
{
	NodeType<ItemType>* newNode;

	newNode = new NodeType<ItemType>;
	newNode->info = newItem;
	newNode->next = NULL;
	if (qRear == NULL)
		qFront = newNode;
	else
		qRear->next = newNode;
	qRear = newNode;
}

template <class ItemType>
void QueType<ItemType>::Dequeue(ItemType& item)
{
	NodeType<ItemType>* tempPtr;

	tempPtr = qFront;
	item = qFront->info;
	qFront = qFront->next;
	if (qFront == NULL)
		qRear = NULL;
	delete tempPtr;
}

template <class ItemType>
void QueType<ItemType>::PrintQue()
{
	NodeType<ItemType>* Currentptr = qFront;

	while (Currentptr != NULL)
	{
		cout << Currentptr->info << " ";
		Currentptr = Currentptr->next;

	}
}

template<class ItemType>
bool QueType<ItemType>::search(ItemType& target)
{
	NodeType<ItemType>* Currentptr = qFront;
	while (Currentptr != NULL)
	{
		if (target == Currentptr->info)
			return 1;

		else
			Currentptr = Currentptr->next;

	}

	return false;
}

template<class ItemType>
int QueType<ItemType>::Size()
{
	int count = 0;
	NodeType<ItemType>* Currentptr = qFront;
	while (Currentptr != NULL)
	{
		if (Currentptr != NULL)
			count++;
		Currentptr = Currentptr->next;
	}

	return count;
}

template<class ItemType>
int QueType<ItemType>::Total()
{
	int sum = 0;
	NodeType<ItemType>* Currentptr = qFront;

	while (Currentptr != NULL)
	{
		sum = sum + Currentptr->info;
		Currentptr = Currentptr->next;
	}

	return sum;
}
