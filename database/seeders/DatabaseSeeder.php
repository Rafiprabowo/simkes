<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\DetailPemeriksaan;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\Employee;
use App\Models\MedicalCheckUp;
use App\Models\Medicine;
use App\Models\MedicineCategories;
use App\Models\NilaiRujukan;
use App\Models\PemeriksaanMajor;
use App\Models\PemeriksaanMinor;
use App\Models\Pharmacist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $speciality1 = DoctorSpecialization::factory()->create([
                'name' => 'Dokter Umum'
            ]
        );
        $speciality2 = DoctorSpecialization::factory()->create([
            'name' => 'Sp. Mata'
        ]);
        $speciality2 = DoctorSpecialization::factory()->create([
            'name' => 'Sp. PD'
        ]);
        $speciality3 = DoctorSpecialization::factory()->create([
            'name' => 'Sp. Rad'
        ]);
        $speciality4 = DoctorSpecialization::factory()->create([
            'name' => 'Sp. THT'
        ]);
        $speciality5 = DoctorSpecialization::factory()->create([
            'name' => 'Sp. Kulit & Kelamin'
        ]);
        $userDokter1 = \App\Models\User::factory()->create([
             'role' => 'dokter',
         ]);
        $doctor1 = Doctor::factory()->create([
             'user_id' => $userDokter1->id,
             'speciality_id' => $speciality1->id,
         ]);
        $userDokter2 = \App\Models\User::factory()->create([
            'role' => 'dokter',
        ]);
        $doctor2 = Doctor::factory()->create([
            'user_id' => $userDokter2->id,
            'speciality_id' => $speciality2->id,
        ]);
//
        $userDokter3 = \App\Models\User::factory()->create([
            'role' => 'dokter',
        ]);
        $doctor3 = Doctor::factory()->create([
            'user_id' => $userDokter3->id,
            'speciality_id' => $speciality3->id,
        ]);

        $userDokter4 = \App\Models\User::factory()->create([
            'role' => 'dokter',
        ]);
        $doctor4 = Doctor::factory()->create([
            'user_id' => $userDokter4->id,
            'speciality_id' => $speciality4->id,
        ]);

        $userDokter5 = \App\Models\User::factory()->create([
            'role' => 'dokter',
        ]);
        $doctor5 = Doctor::factory()->create([
            'user_id' => $userDokter5->id,
            'speciality_id' => $speciality5->id,
        ]);
         $userPegawai1 = \App\Models\User::factory()->create([
             'role' => 'pegawai'
         ]);
         $employee1 = Employee::factory()->create([
            'user_id' => $userPegawai1->id,
        ]);

         $userPegawai2 = \App\Models\User::factory()->create([
             'role' => 'pegawai'
         ]);
         $employee2 = Employee::factory()->create([
             'user_id' => $userPegawai2->id,
         ]);
         $userPegawai3 = \App\Models\User::factory()->create([
             'role' => 'pegawai'
         ]);
         $employee3 = Employee::factory()->create([
             'user_id' => $userPegawai3->id,
         ]);
         $userPegawai4 = \App\Models\User::factory()->create([
             'role' => 'pegawai'
         ]);
         $employee4 = Employee::factory()->create([
             'user_id' => $userPegawai4->id,
         ]);
         $userPegawai5 = \App\Models\User::factory()->create([
             'role' => 'pegawai'
         ]);
         $employee5 = Employee::factory()->create([
             'user_id' => $userPegawai5->id,
         ]);
         $userAdmin1 = \App\Models\User::factory()->create([
             'role' => 'admin'
         ]);
         $admin1 = Admin::create([
             'user_id' => $userAdmin1->id
         ]);

         $userAdmin2 = \App\Models\User::factory()->create([
             'role' => 'admin'
         ]);
         $admin2 = Admin::create([
             'user_id' => $userAdmin2->id,
         ]);
         $userAdmin3 = \App\Models\User::factory()->create([
             'role' => 'admin'
         ]);
         $admin3 = Admin::create([
             'user_id' => $userAdmin3->id,
         ]);
         $userAdmin4 = \App\Models\User::factory()->create([
             'role' => 'admin'
         ]);
         $admin4 = Admin::create([
             'user_id' => $userAdmin4->id,
         ]);
         $userAdmin5 = \App\Models\User::factory()->create([
             'role' => 'admin'
         ]);


         $userApoteker1 = \App\Models\User::factory()->create([
            'role' => 'apoteker'
         ]);
         $apoteker1 = Pharmacist::create([
             'user_id' =>$userApoteker1->id
         ]);
         $userApoteker2 = \App\Models\User::factory()->create([
             'role' => 'apoteker'
         ]);
         $apoteker2 = Pharmacist::create([
            'user_id' => $userApoteker2->id,
         ]);
         $userApoteker3 = \App\Models\User::factory()->create([
             'role' => 'apoteker'
         ]);
         $apoteker3 = Pharmacist::create([
             'user_id' => $userApoteker3->id,
         ]);
         $userApoteker4 = \App\Models\User::factory()->create([
             'role' => 'apoteker'
         ]);
         $apoteker4 = Pharmacist::create([
             'user_id' => $userApoteker4->id,
         ]);
         $userApoteker5 = \App\Models\User::factory()->create([
             'role' => 'apoteker'
         ]);
         $apoteker5 = Pharmacist::create([
             'user_id' => $userApoteker5->id,
         ]);

         $kategoriObat1 = MedicineCategories::create([
             'name' => 'Analgesik',
             'description' => 'Penghilang Nyeri'
         ]);
         $panadol = Medicine::create(['category_id' => $kategoriObat1->id,
             'name' => 'PANADOL',
             'description' => 'Panadol merupakan obat dengan Paracetamol yang digunakan untuk meringankan rasa sakit pada sakit kepala ',
             'satuan' => 'Tablet',
             'stock' => 100,
             ]);
          $ibuproven = Medicine::create([
             'category_id' => $kategoriObat1->id,
             'name' => 'Ibuprofen',
             'description' => 'Untuk menghilangkan rasa nyeri dan inflamasi',
              'satuan' => 'Tablet',
              'stock' => 100,
         ]);

         $kategoriObat2 = MedicineCategories::create([
             'name' => 'Antibiotik',
             'description' => 'Antibiotik'
         ]);
         $amoxcilin = Medicine::create([
             'category_id' => $kategoriObat2->id,
             'name' => 'Amoxcilin',
             'description' => 'Amoxicillin adalah antibiotik yang termasuk dalam kelas penicillin. Antibiotik ini digunakan untuk mengobati berbagai infeksi bakteri',
             'satuan' => 'Tablet',
             'stock' => 100,
         ]);
         $sefalosportin = Medicine::create([
             'category_id' => $kategoriObat2->id,
             'name' => 'Sefalosportin',
             'description' => 'Sefalosporin adalah kelompok antibiotik yang digunakan untuk mengobati berbagai infeksi bakteri',
             'satuan' => 'Tablet',
             'stock' => 100,
         ]);
         $kategoriObat3 = MedicineCategories::create([
             'name' => 'Antipiretik',
             'description' => 'Penurun Panas'
         ]);
         $paracetamol = Medicine::create([
             'category_id' => $kategoriObat3->id,
             'name' => 'Paracetamol',
             'description' => 'Parasetamol adalah antipiretik yang sering digunakan untuk menurunkan demam pada anak-anak dan orang dewasa',
             'satuan' => 'Tablet',
             'stock' => 100,
         ]);

         $kategoriObat4 = MedicineCategories::create([
             'name' => 'Antiinflamasi Nonsteroid',
             'description' => 'Antiinflamasi'
         ]);

         $kategoriObat5 = MedicineCategories::create([
             'name' => 'Antidepresan',
             'description' => 'Antidepresan'
         ]);
         $kategoriObat6 =  MedicineCategories::create([
             'name' => 'Antiemetik',
             'description' => 'Anti mual dan muntah'
         ]);
         $kategoriObat7 = MedicineCategories::create([
             'name' => 'Antihistamin',
             'description' => 'Antialergi'
         ]);
         $cetirizine = Medicine::create([
             'category_id' => $kategoriObat7->id,
             'name' => 'Cetirizine',
             'description' => 'Cetirizine adalah obat antihistamin yang digunakan untuk mengatasi gejala alergi. ',
             'satuan' => 'Tablet',
             'stock' => 100,
         ]);
         $loratadine = Medicine::create([
             'category_id' => $kategoriObat7->id,
             'name' => 'Loratadine',
             'description' => 'Loratadine adalah antihistamin non-penenang yang digunakan untuk meredakan gejala alergi',
             'satuan' => 'Tablet',
             'stock' => 100,
         ]);
         $kategoriObat8 = MedicineCategories::create([
             'name' => 'Antihipertensi',
             'description' => 'Pengontrol Tekanan Darah'
         ]);
         $aceinhibitor = Medicine::create([
             'category_id' => $kategoriObat8->id,
             'name' => 'Ace inhibitor',
             'description' => 'ACE Inhibitor adalah obat yang digunakan untuk mengontrol tekanan darah tinggi dan mengobati kondisi jantung',
             'satuan' => 'Kapsul',
             'stock' => 100,
         ]);

         $kategoriObat9 = MedicineCategories::create([
             'name' => 'Antidiabetik',
             'description' => 'Antidiabetik'
         ]);
         $metformin = Medicine::create([
            'category_id' => $kategoriObat9->id,
            'name' => 'Metformin',
            'description' => 'Metformin adalah obat yang digunakan untuk mengontrol kadar gula darah pada penderita diabetes tipe 2',
             'satuan' => 'Tablet',
             'stock' => 100,
         ]);
         $betaBlocker = Medicine::create([
             'category_id' => $kategoriObat9->id,
             'name' => 'BetaBlocker',
             'description' => 'Beta Blocker (Penghambat Beta) adalah kelompok obat yang digunakan untuk mengatasi berbagai kondisi kardiovaskular',
             'satuan' => 'Tablet',
             'stock' => 100,
         ]);
         $kategoriObat10 = MedicineCategories::create([
             'name' => 'Hipnotik dan Sedatif',
             'description' => 'Hipnotik dan Sedatif'
         ]);




         $pemeriksaanMajorHematologi = PemeriksaanMajor::factory()->create([
                'name' => ' Hematologi',
         ]);

         $hemoglobin = PemeriksaanMinor::factory()->create([
             'name' => 'hemoglobin',
             'id_pemeriksaan_major' =>$pemeriksaanMajorHematologi->id
         ]);
         $hemoglobinReferenceL = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $hemoglobin->id,
             'gender' => 'L',
             'reference_value' => '12 - 16',
             'satuan' => 'gram %'
         ]);
         $hemoglobinReferenceP = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $hemoglobin->id,
             'gender' => 'P',
             'reference_value' => '12 - 16',
             'satuan' => 'gram %'
         ]);

         $hematocrit = PemeriksaanMinor::factory()->create([
            'name' => 'hematocrit',
             'id_pemeriksaan_major' =>$pemeriksaanMajorHematologi->id
         ]);
         $hematocritReferenceL = NilaiRujukan::factory()->create([
            'id_pemeriksaan_minor' => $hematocrit->id,
            'gender' => 'L',
            'reference_value' => '37 - 43',
             'satuan' => '%'
         ]);
         $hematocritReferenceP = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $hematocrit->id,
             'gender' => 'P',
             'reference_value' => '37 - 43',
             'satuan' => '%'
         ]);

         $eritrosit  = PemeriksaanMinor::factory()->create([
             'name' => 'eritrosiit',
             'id_pemeriksaan_major' =>$pemeriksaanMajorHematologi->id
         ]);

         $eritrosiitReferenceL = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $eritrosit->id,
             'gender' => 'L',
             'reference_value' => '4,2 - 5,4',
             'satuan' => 'juta mm3'
         ]);
         $eritrosiitReferenceP = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $eritrosit->id,
             'gender' => 'P',
             'reference_value' => '4,2 - 5,4',
             'satuan' => 'juta mm3'
         ]);
         $lekosit  = PemeriksaanMinor::factory()->create([
             'name' => 'lekosit',
             'id_pemeriksaan_major' =>$pemeriksaanMajorHematologi->id
         ]);
         $lekositReferenceL = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $lekosit->id,
             'gender' => 'L',
             'reference_value' => '4000 - 10000',
             'satuan' => 'mm3'
         ]);
         $lekositReferenceP = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $lekosit->id,
             'gender' => 'P',
             'reference_value' => '4000 - 10000',
             'satuan' => 'mm3'
         ]);
         $trombosit = PemeriksaanMinor::factory()->create([
             'name' => 'trombosit',
             'id_pemeriksaan_major' =>$pemeriksaanMajorHematologi->id
         ]);

         $trombositReferenceL = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $trombosit->id,
             'gender' => 'L',
             'reference_value' => '150.000 - 450.000',
             'satuan' => 'mm3'
         ]);
         $trombositReferenceP = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $trombosit->id,
             'gender' => 'P',
             'reference_value' => '150.000 - 450.000',
             'satuan' => 'mm3'
         ]);

         $lajuEndapDarah = PemeriksaanMinor::factory()->create([
            'name' => 'Laju Endap Darah',
             'id_pemeriksaan_major' =>$pemeriksaanMajorHematologi->id
         ]);
         $lajuEndapDarahReferenceL = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $lajuEndapDarah->id,
             'gender' => 'L',
             'reference_value' => '0 - 20',
             'satuan' => 'mm/jam'
         ]);
         $lajuEndapDarahReferenceP = NilaiRujukan::factory()->create([
             'id_pemeriksaan_minor' => $lajuEndapDarah->id,
             'gender' => 'P',
             'reference_value' => '0 - 20',
             'satuan' => 'mm/jam'
         ]);






















    }
}
