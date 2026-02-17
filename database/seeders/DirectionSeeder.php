<?php

namespace Database\Seeders;

use App\Models\Direction;
use App\Models\EducationLevel;
use App\Models\StudyForm;
use Illuminate\Database\Seeder;

class DirectionSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. Education Levels (Ta'lim darajasi)
        // ==========================================
        $bakalavr = EducationLevel::firstOrCreate(
            ['title' => 'Bakalavr'],
            ['status' => true]
        );

        $magistr = EducationLevel::firstOrCreate(
            ['title' => 'Magistr'],
            ['status' => true]
        );

        $ordinatura = EducationLevel::firstOrCreate(
            ['title' => 'Ordinatura'],
            ['status' => true]
        );

        // ==========================================
        // 2. Study Forms (Ta'lim shakli)
        // ==========================================
        $bakalavr_kunduzgi = StudyForm::firstOrCreate(
            ['education_level_id' => $bakalavr->id, 'title' => 'Kunduzgi'],
            ['status' => true]
        );

        $bakalavr_sirtqi = StudyForm::firstOrCreate(
            ['education_level_id' => $bakalavr->id, 'title' => 'Sirtqi'],
            ['status' => true]
        );

        $bakalavr_ikkinchi_oliy = StudyForm::firstOrCreate(
            ['education_level_id' => $bakalavr->id, 'title' => 'Ikkinchi oliy (sirtqi)'],
            ['status' => true]
        );

        $magistr_kunduzgi = StudyForm::firstOrCreate(
            ['education_level_id' => $magistr->id, 'title' => 'Kunduzgi'],
            ['status' => true]
        );

        $ordinatura_kunduzgi = StudyForm::firstOrCreate(
            ['education_level_id' => $ordinatura->id, 'title' => 'Kunduzgi'],
            ['status' => true]
        );

        // ==========================================
        // 3. Directions (Yo'nalishlar)
        // ==========================================

        $directions = [
            // ============================================================
            // IQTISODIYOT VA AXBOROT TEXNOLOGIYALARI FAKULTETI (Bakalavr)
            // ============================================================

            // Axborot tizimlari va texnologiyalari: K=14 mln, S=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Axborot tizimlari va texnologiyalari', 'code' => '60610100-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Axborot tizimlari va texnologiyalari', 'code' => '60610100-S', 'contract_price' => 13_000_000],

            // Axborot tizimlari va texnologiyalari (tarmoqlar va sohalar bo'yicha): K=14 mln, S=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Axborot tizimlari va texnologiyalari (tarmoqlar va sohalar bo'yicha)", 'code' => '60610200-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => "Axborot tizimlari va texnologiyalari (tarmoqlar va sohalar bo'yicha)", 'code' => '60610200-S', 'contract_price' => 13_000_000],

            // Bank ishi: K=15 mln, S=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Bank ishi', 'code' => '60410600-K', 'contract_price' => 15_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Bank ishi', 'code' => '60410600-S', 'contract_price' => 13_000_000],

            // Bank ishi va auditi: K=15 mln, S=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Bank ishi va auditi', 'code' => '60410500-K', 'contract_price' => 15_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Bank ishi va auditi', 'code' => '60410500-S', 'contract_price' => 13_000_000],

            // Buxgalteriya hisobi: K=15 mln, S=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Buxgalteriya hisobi', 'code' => '60410200-K', 'contract_price' => 15_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Buxgalteriya hisobi', 'code' => '60410200-S', 'contract_price' => 13_000_000],

            // Buxgalteriya hisobi va audit (tarmoqlar bo'yicha): K=15 mln, S=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Buxgalteriya hisobi va audit (tarmoqlar bo'yicha)", 'code' => '60410100-K', 'contract_price' => 15_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => "Buxgalteriya hisobi va audit (tarmoqlar bo'yicha)", 'code' => '60410100-S', 'contract_price' => 13_000_000],

            // Iqtisodiyot: K=15 mln, S=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Iqtisodiyot', 'code' => '60410100-IQ-K', 'contract_price' => 15_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Iqtisodiyot', 'code' => '60410100-IQ-S', 'contract_price' => 13_000_000],

            // Iqtisodiyot (tarmoqlar va sohalar bo'yicha): K=15 mln, S=13 mln, IO=8.9 mln
            ['study_form' => $bakalavr_kunduzgi,     'title' => "Iqtisodiyot (tarmoqlar va sohalar bo'yicha)", 'code' => '60310100-K',  'contract_price' => 15_000_000],
            ['study_form' => $bakalavr_sirtqi,        'title' => "Iqtisodiyot (tarmoqlar va sohalar bo'yicha)", 'code' => '60310100-S',  'contract_price' => 13_000_000],
            ['study_form' => $bakalavr_ikkinchi_oliy, 'title' => "Iqtisodiyot (tarmoqlar va sohalar bo'yicha)", 'code' => '60310100-IO', 'contract_price' => 8_900_000],

            // Jahon iqtisodiyoti va xalqaro iqtisodiy munosabatlar: K=17 mln, S=14 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Jahon iqtisodiyoti va xalqaro iqtisodiy munosabatlar', 'code' => '60411100-K', 'contract_price' => 17_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Jahon iqtisodiyoti va xalqaro iqtisodiy munosabatlar', 'code' => '60411100-S', 'contract_price' => 14_000_000],

            // Jahon iqtisodiyoti va xalqaro iqtisodiy munosabatlar (mintaqalar va faoliyat turlari bo'yicha): K=17 mln, S=14 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Jahon iqtisodiyoti va xalqaro iqtisodiy munosabatlar (mintaqalar va faoliyat turlari bo'yicha)", 'code' => '60411900-K', 'contract_price' => 17_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => "Jahon iqtisodiyoti va xalqaro iqtisodiy munosabatlar (mintaqalar va faoliyat turlari bo'yicha)", 'code' => '60411900-S', 'contract_price' => 14_000_000],

            // Maktab menejmenti: S=11 mln
            ['study_form' => $bakalavr_sirtqi, 'title' => 'Maktab menejmenti', 'code' => '60112500-S', 'contract_price' => 11_000_000],

            // Matematika: K=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Matematika', 'code' => '60540100-K', 'contract_price' => 13_000_000],

            // Moliya va moliyaviy texnologiyalar (60410400): K=15 mln, S=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Moliya va moliyaviy texnologiyalar', 'code' => '60410400-K', 'contract_price' => 15_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Moliya va moliyaviy texnologiyalar', 'code' => '60410400-S', 'contract_price' => 13_000_000],

            // Moliya va moliyaviy texnologiyalar (60410500): K=15 mln, S=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Moliya va moliyaviy texnologiyalar', 'code' => '60410500-MF-K', 'contract_price' => 15_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Moliya va moliyaviy texnologiyalar', 'code' => '60410500-MF-S', 'contract_price' => 13_000_000],

            // Soliqlar va soliqqa tortish: K=15 mln, S=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Soliqlar va soliqqa tortish', 'code' => '60410300-K', 'contract_price' => 15_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Soliqlar va soliqqa tortish', 'code' => '60410300-S', 'contract_price' => 13_000_000],

            // Turizm (faoliyat yo'nalishlari bo'yicha): K=14 mln, S=11 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Turizm (faoliyat yo'nalishlari bo'yicha)", 'code' => '61010400-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => "Turizm (faoliyat yo'nalishlari bo'yicha)", 'code' => '61010400-S', 'contract_price' => 11_000_000],

            // Turizm va mehmondo'stlik: K=14 mln, S=11 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Turizm va mehmondo'stlik", 'code' => '61010100-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => "Turizm va mehmondo'stlik", 'code' => '61010100-S', 'contract_price' => 11_000_000],

            // ============================================================
            // PEDAGOGIKA VA IJTIMOIY-GUMANITAR FANLAR FAKULTETI (Bakalavr)
            // ============================================================

            // Boshlang'ich ta'lim (60110500): K=13 mln, S=11 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Boshlang'ich ta'lim", 'code' => '60110500-K', 'contract_price' => 13_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => "Boshlang'ich ta'lim", 'code' => '60110500-S', 'contract_price' => 11_000_000],

            // Boshlang'ich ta'lim (60110400): K=13 mln, S=11 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Boshlang'ich ta'lim", 'code' => '60110400-K', 'contract_price' => 13_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => "Boshlang'ich ta'lim", 'code' => '60110400-S', 'contract_price' => 11_000_000],

            // Filologiya va tillarni o'qitish (ingliz tili): K=15 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Filologiya va tillarni o'qitish (ingliz tili)", 'code' => '60230101-K', 'contract_price' => 15_000_000],

            // Filologiya va tillarni o'qitish (o'zbek tili): K=15 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Filologiya va tillarni o'qitish (o'zbek tili)", 'code' => '60230100-K', 'contract_price' => 15_000_000],

            // Filologiya va tillarni o'qitish: rus tili: K=15 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Filologiya va tillarni o'qitish: rus tili", 'code' => '60230100-RU-K', 'contract_price' => 15_000_000],

            // Jismoniy madaniyat (60111200): K=13 mln, K=14 mln, S=12 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Jismoniy madaniyat', 'code' => '60111200-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Jismoniy madaniyat', 'code' => '60111200-S', 'contract_price' => 12_000_000],

            // Jismoniy madaniyat (60112200): K=14 mln, S=12 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Jismoniy madaniyat', 'code' => '60112200-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Jismoniy madaniyat', 'code' => '60112200-S', 'contract_price' => 12_000_000],

            // Maktabgacha ta'lim: K=14 mln, S=11 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Maktabgacha ta'lim", 'code' => '60110200-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => "Maktabgacha ta'lim", 'code' => '60110200-S', 'contract_price' => 11_000_000],

            // Maktabgacha va boshlang'ich ta'limda xorijiy til (ingliz tili): K=15 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Maktabgacha va boshlang'ich ta'limda xorijiy til (ingliz tili)", 'code' => '60112600-K', 'contract_price' => 15_000_000],

            // Pedagogika va psixologiya: K=14 mln, S=11 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Pedagogika va psixologiya', 'code' => '60110100-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Pedagogika va psixologiya', 'code' => '60110100-S', 'contract_price' => 11_000_000],

            // Psixologiya: K=14 mln, S=12 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Psixologiya', 'code' => '60310300-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Psixologiya', 'code' => '60310300-S', 'contract_price' => 12_000_000],

            // Tarix (60111100): K=14 mln, S=12 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Tarix', 'code' => '60111100-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Tarix', 'code' => '60111100-S', 'contract_price' => 12_000_000],

            // Tarix (60220300): K=14 mln, S=12 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Tarix', 'code' => '60220300-K', 'contract_price' => 14_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => 'Tarix', 'code' => '60220300-S', 'contract_price' => 12_000_000],

            // Texnologik ta'lim: K=13 mln, S=11 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Texnologik ta'lim", 'code' => '60111300-K', 'contract_price' => 13_000_000],
            ['study_form' => $bakalavr_sirtqi,   'title' => "Texnologik ta'lim", 'code' => '60111300-S', 'contract_price' => 11_000_000],

            // Xorijiy til va adabiyoti (60110900): K=15 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Xorijiy til va adabiyoti', 'code' => '60110900-K', 'contract_price' => 15_000_000],

            // Xorijiy til va adabiyoti (ingliz tili) (60111800): K=15 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Xorijiy til va adabiyoti (ingliz tili)', 'code' => '60111800-K', 'contract_price' => 15_000_000],

            // ============================================================
            // TIBBIYOT FAKULTETI (Bakalavr)
            // ============================================================

            // Biologiya: K=13 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Biologiya', 'code' => '60510100-K', 'contract_price' => 13_000_000],

            // Davolash ishi: K=24 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Davolash ishi', 'code' => '60910200-K', 'contract_price' => 24_000_000],

            // Farmatsiya: K=35 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Farmatsiya', 'code' => '60910800-K', 'contract_price' => 35_000_000],

            // Pediatriya ishi: K=24 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => 'Pediatriya ishi', 'code' => '60910300-K', 'contract_price' => 24_000_000],

            // Stomatologiya (yo'nalishlar bo'yicha): K=27 mln
            ['study_form' => $bakalavr_kunduzgi, 'title' => "Stomatologiya (yo'nalishlar bo'yicha)", 'code' => '60910100-K', 'contract_price' => 27_000_000],

            // ============================================================
            // MAGISTRATURA
            // ============================================================

            // Akusherlik va ginekologiya: 20 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Akusherlik va ginekologiya', 'code' => '70910201-M', 'contract_price' => 20_000_000],

            // Davlat moliyasi va xalqaro moliya: 19 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Davlat moliyasi va xalqaro moliya', 'code' => '70410401-M', 'contract_price' => 19_000_000],

            // Davlat moliyaviy nazorati va auditi: 19 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Davlat moliyaviy nazorati va auditi', 'code' => '70410506-M', 'contract_price' => 19_000_000],

            // Iqtisodiyot: 18 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Iqtisodiyot', 'code' => '70410102-M', 'contract_price' => 18_000_000],

            // Kompyuter tizimlari va ularning dasturiy ta'minoti: 18 mln
            ['study_form' => $magistr_kunduzgi, 'title' => "Kompyuter tizimlari va ularning dasturiy ta'minoti", 'code' => '70610101-M', 'contract_price' => 18_000_000],

            // Matematika: 18 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Matematika', 'code' => '70540101-M', 'contract_price' => 18_000_000],

            // Stomatologiya: 20 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Stomatologiya', 'code' => '70910101-M', 'contract_price' => 20_000_000],

            // Ta'lim va tarbiya nazariyasi va metodikasi (boshlang'ich ta'lim): 18 mln
            ['study_form' => $magistr_kunduzgi, 'title' => "Ta'lim va tarbiya nazariyasi va metodikasi (boshlang'ich ta'lim)", 'code' => '70110401-M', 'contract_price' => 18_000_000],

            // Tarix: 18 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Tarix', 'code' => '70220301-M', 'contract_price' => 18_000_000],

            // Terapiya: 20 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Terapiya', 'code' => '70910203-M', 'contract_price' => 20_000_000],

            // Urologiya: 20 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Urologiya', 'code' => '70910217-M', 'contract_price' => 20_000_000],

            // Xirurgiya: 20 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Xirurgiya', 'code' => '70910212-M', 'contract_price' => 20_000_000],

            // Xorijiy til va adabiyoti: 18 mln
            ['study_form' => $magistr_kunduzgi, 'title' => 'Xorijiy til va adabiyoti', 'code' => '70110901-M', 'contract_price' => 18_000_000],

            // ============================================================
            // ORDINATURA (Tibbiyot)
            // ============================================================

            // Akusherlik va ginekologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Akusherlik va ginekologiya', 'code' => '80910201-O', 'contract_price' => 12_000_000],

            // Dermatovenerologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Dermatovenerologiya', 'code' => '80910208-O', 'contract_price' => 12_000_000],

            // Endokrinologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Endokrinologiya', 'code' => '80910202-O', 'contract_price' => 12_000_000],

            // Kardiologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Kardiologiya', 'code' => '80910205-O', 'contract_price' => 12_000_000],

            // Nevrologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Nevrologiya', 'code' => '80910209-O', 'contract_price' => 12_000_000],

            // Oftalmologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Oftalmologiya', 'code' => '80910206-O', 'contract_price' => 12_000_000],

            // Ortopedik stomatologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Ortopedik stomatologiya', 'code' => '80910706-O', 'contract_price' => 12_000_000],

            // Otorinolaringologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Otorinolaringologiya', 'code' => '80910204-O', 'contract_price' => 12_000_000],

            // Terapevtik stomatologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Terapevtik stomatologiya', 'code' => '80910708-O', 'contract_price' => 12_000_000],

            // Terapiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Terapiya', 'code' => '80910203-O', 'contract_price' => 12_000_000],

            // Tibbiy radiologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Tibbiy radiologiya', 'code' => '80910227-O', 'contract_price' => 12_000_000],

            // Travmatologiya va ortopediya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Travmatologiya va ortopediya', 'code' => '80910221-O', 'contract_price' => 12_000_000],

            // Umumiy onkologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Umumiy onkologiya', 'code' => '80910210-O', 'contract_price' => 12_000_000],

            // Urologiya: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => 'Urologiya', 'code' => '80910217-O', 'contract_price' => 12_000_000],

            // Yuz-jag' xirurgiyasi: 12 mln
            ['study_form' => $ordinatura_kunduzgi, 'title' => "Yuz-jag' xirurgiyasi", 'code' => '80910710-O', 'contract_price' => 12_000_000],
        ];

        foreach ($directions as $directionData) {
            Direction::firstOrCreate(
                [
                    'code' => $directionData['code'],
                ],
                [
                    'study_form_id'  => $directionData['study_form']->id,
                    'title'          => $directionData['title'],
                    'contract_price' => $directionData['contract_price'],
                ]
            );
        }

        $this->command->info('✅ ' . count($directions) . ' ta yo\'nalish muvaffaqiyatli qo\'shildi!');
    }
}
