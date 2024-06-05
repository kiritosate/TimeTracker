using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using System.Configuration;

namespace TimeTracker
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            try
            {
                //login user
                new dashboard().Show();
                this.Hide();
            }catch(Exception ex)
            {
                //catch error
            }
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            try
            {
                MySqlConnection con = new MySqlConnection(ConfigurationManager.ConnectionStrings["TimeTracker"].ConnectionString);

                con.Open();
                con.Close();

            }catch(Exception ex)
            {
                MessageBox.Show("Database is not Runnning, start your MySql Server, and try again "+ex.Message, "System Error");
            }
        }
    }
}
