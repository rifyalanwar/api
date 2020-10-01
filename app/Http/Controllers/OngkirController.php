<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OngkirController extends Controller
{
    public function GetProvinsi()
    {
        $API_ONGKIR_KEY = env('API_ONGKIR_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $API_ONGKIR_KEY"
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $response=json_decode($response,true);
        $data_provinsi = $response['rajaongkir']['results'];
        return $data_provinsi;
    }

    public function GetKota($id)
    {
       
        $API_ONGKIR_KEY = env('API_ONGKIR_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/city?&province=$id",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: $API_ONGKIR_KEY"
          ),
        )); 
        $response = curl_exec($curl);
        $err = curl_error($curl);   
        curl_close($curl);
        $response=json_decode($response,true);
        $data_kota = $response['rajaongkir']['results'];
        return json_encode($data_kota);
    }

    public function GetKecamatan($id)
    {
        $API_ONGKIR_KEY = env('API_ONGKIR_KEY');
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $API_ONGKIR_KEY"
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);   
        curl_close($curl);
        $response=json_decode($response,true);
        $data_kota = $response['rajaongkir']['results'];
        return json_encode($data_kota);

    }

    public function GetOngkir(Request $request)
    {
        $pengirim = $request->kota_pengirim;
        $penerima = $request->kecamatan_penerima;
        $berat = $request->berat;
        $kurir = $request->kurir;

        $API_ONGKIR_KEY = env('API_ONGKIR_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=$pengirim&originType=city&destination=$penerima&destinationType=subdistrict&weight=$berat&courier=$kurir",
        CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: $API_ONGKIR_KEY"
        ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);   
        curl_close($curl);
        $response=json_decode($response,true);
        $data_ongkir = $response['rajaongkir']['results'];
        return json_encode($data_ongkir);
    }
}
