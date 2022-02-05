<?php
function check_already_login()
{

	$ci = &get_instance();
	$user_session = $ci->session->userdata('userid');
	if ($user_session) {
		redirect('dashboard');
	}
}

//untuk semua ctrl cek seesion login dan session unit
function is_login()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('userid');
	if (!$user_session) {
		redirect('auth');
	}
}

//untuk bagian dashboard saja
function cek_login_aja()
{
	$ci = &get_instance();
	$user_session = $ci->session->userdata('userid');
	if (!$user_session) {
		redirect('auth');
	}
}

//akses menu
function check_access($level_id, $sub_menu_id)
{
	$ci = get_instance();
	$ci->db->where('level_id', $level_id);
	$ci->db->where('sub_menu_id', $sub_menu_id);
	$result = $ci->db->get('user_access_menu');
	if ($result->num_rows() > 0) {
		return "checked='checked'";
	}
}

//acces_create
function check_access_create($level_id, $menu_id)
{
	$ci = get_instance();
	$ci->db->where('level_id', $level_id);
	$ci->db->where('sub_menu_id', $menu_id);
	$result = $ci->db->get('user_access_menu');
	if ($result->num_rows() > 0) {
		$row = $result->row();
		if ($row->create == 1) {
			return "checked='checked'";
		}
	}
}

//acces_update
function check_access_update($level_id, $menu_id)
{
	$ci = get_instance();
	$ci->db->where('level_id', $level_id);
	$ci->db->where('sub_menu_id', $menu_id);
	$result = $ci->db->get('user_access_menu');
	if ($result->num_rows() > 0) {
		$row = $result->row();
		if ($row->update == 1) {
			return "checked='checked'";
		}
	}
}

//acces_delete
function check_access_delete($level_id, $menu_id)
{
	$ci = get_instance();
	$ci->db->where('level_id', $level_id);
	$ci->db->where('sub_menu_id', $menu_id);
	$result = $ci->db->get('user_access_menu');
	if ($result->num_rows() > 0) {
		$row = $result->row();
		if ($row->delete == 1) {
			return "checked='checked'";
		}
	}
}


//format rupiah
function rupiah($angka =null)
{
	if($angka==null){
		return 0;
	}else{
		$hasil_rupiah = number_format($angka, 0, ',', '.');
		return $hasil_rupiah;
	}

	
}


//is_allowed
function is_allowed($nama_menu, $access = null)
{
	$ci = &get_instance();
	$ci->load->library('fungsi');
	$user_session = $ci->fungsi->user_login()->level_id;
	$ci->db->select('user_access_menu.*,sub_menu.url');
	$ci->db->from('user_access_menu');
	$ci->db->join('sub_menu', 'sub_menu.sub_menu_id = user_access_menu.sub_menu_id', 'left');
	$ci->db->where('url', $nama_menu);
	$ci->db->where('level_id', $user_session);
	if ($access != null) {
		$ci->db->where($access, 1);
	}
	$query = $ci->db->get();
	if ($query->num_rows() < 1) {
		redirect('not_access');
	}
}

//is_allowed_button
function is_allowed_button($nama_menu, $access = null)
{
	$ci = &get_instance();
	$ci->load->library('fungsi');
	$user_session = $ci->fungsi->user_login()->level_id;
	$ci->db->select('user_access_menu.*,sub_menu.url');
	$ci->db->from('user_access_menu');
	$ci->db->join('sub_menu', 'sub_menu.sub_menu_id = user_access_menu.sub_menu_id', 'left');
	$ci->db->where('url', $nama_menu);
	$ci->db->where('level_id', $user_session);
	if ($access != null) {
		$ci->db->where($access, 1);
	}
	$query = $ci->db->get();
	$hasil = $query->num_rows();
	return $hasil;
}

function remark_name($remark_id)
{
	$ci = &get_instance();
	if ($remark_id != 0) {
		$data = $ci->db->query("SELECT * FROM remark where remark_id='$remark_id'")->row();
		return $data->remark_code.' - '.$data->remark_name;
	} else {
		return "-";
	}
}

function toEnglish($number)
    {
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ' ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . toEnglish(abs($number));
        }

        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string    = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . toEnglish($remainder);
                }
                break;
            default:
                $baseUnit     = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder    = $number % $baseUnit;
                $string       = toEnglish($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= toEnglish($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return ucwords($string);
    }
