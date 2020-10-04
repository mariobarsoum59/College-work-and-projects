using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Coin_Change
{
    public partial class Form1 : Form
    {

        public Form1()
        {
            InitializeComponent();
        }

        static double[] coins = { 0.02, 0.05, 0.10, 0.20, 0.50, 1.00, 2.00 };
        static int n = coins.Length;




        private void BtnCalculate_Click(object sender, EventArgs e)
        {
            double amount = Convert.ToDouble(txtAmount.Text);

            List<double> ans = new List<double>();//holds the coins in the list

            // Traverse through coins
            for (int i = n - 1; i >= 0; i--)
            {
                // Find coins 
                while (amount >= coins[i])
                {
                    amount -= coins[i];
                    ans.Add(coins[i]);
                }
            }

            //counter for each coin
            int TwoCount = 0;
            int OneCount = 0;
            int FiftyCount = 0;
            int TwentyCount = 0;
            int tenCount = 0;
            int fiveCount = 0;
            int twoCount = 0;


            foreach (var i in ans)
            {
                if (i == 2.00)
                {
                    TwoCount++;
                }
                if (i == 1.00)
                {
                    OneCount++;
                }
                if (i == 0.50)
                {
                    FiftyCount++;
                }
                if (i == 0.20)
                {
                    TwentyCount++;
                }
                if (i == 0.10)
                {
                    tenCount++;
                }
                if (i == 0.05)
                {
                    fiveCount++;
                }
                if (i == 0.02)
                {
                    twoCount++;
                }

            }
            //display apropiate count in each box
            txt2.Text = TwoCount.ToString("g");
            txt1.Text = OneCount.ToString("g");
            txt0_50.Text = FiftyCount.ToString("g");
            txt0_20.Text = TwentyCount.ToString("g");
            txt0_10.Text = tenCount.ToString("g");
            txt0_05.Text = fiveCount.ToString("g");
            txt0_02.Text = twoCount.ToString("g");

        }

        private void BtnExit_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}
