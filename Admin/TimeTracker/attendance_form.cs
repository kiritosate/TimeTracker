using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net.NetworkInformation;
using System.Net.Sockets;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace TimeTracker
{
    public partial class attendance_form : Form
    {
        public static int attendance_student_id;
        public attendance_form()
        {
            InitializeComponent();
        }

        private void iconButton1_Click(object sender, EventArgs e)
        {
            //refresh the ip address
            label1.Text = "https://" + GetWiFiIPAddress();
        }

        public static string GetWiFiIPAddress()
        {
            foreach (NetworkInterface ni in NetworkInterface.GetAllNetworkInterfaces())
            {
                if (ni.NetworkInterfaceType == NetworkInterfaceType.Wireless80211 && ni.OperationalStatus == OperationalStatus.Up)
                {
                    foreach (UnicastIPAddressInformation ip in ni.GetIPProperties().UnicastAddresses)
                    {
                        if (ip.Address.AddressFamily == AddressFamily.InterNetwork)
                        {
                            return ip.Address.ToString();
                        }
                    }
                }
            }
            return null;
        }

        private void attendance_form_Load(object sender, EventArgs e)
        {
            // TODO: This line of code loads data into the 'dataSet1.attendance_info' table. You can move, or remove it, as needed.
            this.attendance_infoTableAdapter.Fill(this.dataSet1.attendance_info);
            // TODO: This line of code loads data into the 'dataSet1.attendance_info' table. You can move, or remove it, as needed.
            // TODO: This line of code loads data into the 'dataSet1.event_info' table. You can move, or remove it, as needed.
            label1.Text = "https://" + GetWiFiIPAddress();
        }

        private static DataGridViewRow row;
        private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex >= 0)
            {
                row = dataGridView1.Rows[e.RowIndex];
                attendance_student_id = Convert.ToInt32(row.Cells[0].Value);

                textBox1.Text = row.Cells[1].Value.ToString();
                textBox2.Text = row.Cells[2].Value.ToString();
                textBox3.Text = row.Cells[3].Value.ToString();

                textBox4.Text = row.Cells[5].Value.ToString();
                textBox5.Text = row.Cells[6].Value.ToString();
                textBox6.Text = row.Cells[7].Value.ToString();
                textBox7.Text = row.Cells[8].Value.ToString();
            }
        }

        private void iconButton3_Click(object sender, EventArgs e)
        {

        }
    }
}
