#pragma once

template <class ItemType>
void SplitI(ItemType values[], int first, int last, int& splitPt1, int& splitPt2)
{
	::QuickSortIteratveCount++;
	ItemType splitVal = values[(first + last) / 2], t;
	int i = first, j = last;

	while (values[i] < splitVal)
	{
		::QuickSortIteratveCount++;
		i++;
	}
	while (values[j] > splitVal)
	{
		::QuickSortIteratveCount++;
		j--;
	}
	while (i < j)
	{
		::QuickSortIteratveCount++;
		t = values[i];      values[i] = values[j];
		values[j] = t;
		i++;	j--;
		while (values[i] < splitVal)
		{
			::QuickSortIteratveCount++;
			i++;
		}
		while (values[j] > splitVal)
		{
			::QuickSortIteratveCount++;
			j--;
		}
	}
	if (i == j)
	{
		::QuickSortIteratveCount++;
		i++;
		j--;
	}
	splitPt1 = i;
	splitPt2 = j;
}





template <class ItemType>
void QuickSortI(ItemType values[], int first, int last)
{
	const int MAX_STACK = 22;
	int splitPt1, splitPt2;
	int stackTop, stack[MAX_STACK];

	// Push the bounds of the array onto the stack so
	// that the stack is not empty to start.

	stack[0] = first;
	stack[1] = last;
	stackTop = 1;
	// Segements still to sort – Stack Empty?

	while (stackTop > -1)
	{
		::QuickSortIteratveCount++;
		// Pop the set of bounds on top of the stack

		last = stack[stackTop];
		first = stack[stackTop - 1];
		stackTop -= 2;

		// Spit the current segment if it contains
			// more than one element
		while (first < last)
		{
			::QuickSortIteratveCount++;
			SplitI(values, first, last, splitPt1, splitPt2);

			// values[first]..values[splitPt2] <= splitVal
			// values[splitPt1]..values[last] >= splitVal



// Push the LH segment bounds onto the stack
			stack[stackTop + 1] = first;
			stackTop += 2;
			stack[stackTop] = splitPt2;

			// Continue on working with the RH segment
			first = splitPt1;
		}
	}
}