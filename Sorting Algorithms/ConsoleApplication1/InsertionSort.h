#pragma once
template <class ItemType>
void Insertionsort(ItemType numbers[], int n)
{
	int min = numbers[0]; 
	int p = 0;
	for (int i = 1; i < n; i = i + 1)
	{
		::Insertioncount++;
		if (numbers[i] < min)
		{
			::Insertioncount++;
			min = numbers[i];	
			p = i;
		}
	}
	numbers[p] = numbers[0];
	numbers[0] = min;


	for (int i = 2; i < n; i = i + 1)
	{
		::Insertioncount++;
		int x = numbers[i];
		int j = i;
		while (x < numbers[j - 1])
		{
			::Insertioncount++;
			numbers[j] = numbers[j - 1];
			j = j - 1;
			
			
			//print////////////////////
			cout << endl;
			for (int i = 0; i < n; i++)
			{
				cout << numbers[i] << " ";
			}
			cout << endl;
		//////////////////////////
		
		}
		numbers[j] = x;
	}
}