<?php

namespace Database\Seeders;

use App\Models\Kafedra;
use App\Models\User;
use App\Models\Dekan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KafedraSeeder extends Seeder
{
    public function run(): void
    {
        $kafedraData = [
            'Iqtisodiyot va axborot texnologiyalari' => [
                ['title' => 'Iqtisodiyot', 'name' => 'Mamadjanova Tuyg\'unoy Axmadjanovna', 'phone' => '+998937945505'],
                ['title' => 'Buxgalteriya hisobi va statistikasi', 'name' => 'Shodiyev Akbar Ashurovich', 'phone' => '+998902466363'],
                ['title' => 'Axborot texnologiyalari va aniq fanlar', 'name' => 'Xoliyarov Erkin Chorshanbievich', 'phone' => '+998907430547'],
                ['title' => 'Moliya va turizm', 'name' => 'Juraev Xusan Atamuratovich', 'phone' => '+998907474707'],
            ],

            'Pedagogika va ijtimoiy-gumanitar fanlar' => [
                ['title' => 'Pedagogika va psixologiya', 'name' => 'Eshqarayev Ulug\'bek Choriyevich', 'phone' => '+998900711160'],
                ['title' => 'Ijtimoiy fanlar', 'name' => 'Eshkurbonov Sirojiddin Bozorovich', 'phone' => '+998997481589'],
                ['title' => 'Xorijiy til va adabiyot', 'name' => 'Uralova Oysuluv Poyon qizi', 'phone' => '+998919119292'],
                ['title' => 'Ingliz filologiyasi', 'name' => 'Abdunazarov O\'ktam Qushoqovich', 'phone' => '+998990212525'],
                ['title' => 'Rus tili va adabiyoti', 'name' => 'Sattarova Yelena Anatolevna', 'phone' => '+998771122425'],
                ['title' => 'Tarix', 'name' => 'Yormatov Faxriddin Joylovovich', 'phone' => '+998937910773'],
                ['title' => 'Maktabgacha va boshlang\'ich ta\'lim nazariyasi', 'name' => 'Ismoilov Bobur Tohirovich', 'phone' => '+998919056600'],
                ['title' => 'Boshlang\'ich ta\'lim metodikasi', 'name' => 'Salomov G\'ulom Yo\'ldoshevich', 'phone' => '+998996779488'],
                ['title' => 'O\'zbek tili va adabiyoti', 'name' => 'Norkulova Shaxnoza Tulkinovna', 'phone' => '+998905199633'],
                ['title' => 'Jismoniy madaniyat', 'name' => 'Usmonov Mansur Qurbonmurotovich', 'phone' => '+998902264112'],
            ],

            'Tibbiyot' => [
                ['title' => 'Tabiiy fanlar', 'name' => 'Rasulov Abdusamat Abdujabborovich', 'phone' => '+998995205774'],
                ['title' => 'Tibbiy klinik fanlar', 'name' => 'Saidov Jasur Baxtiyarovich', 'phone' => '+998996666232'],
                ['title' => 'Tibbiy fundamental fanlar', 'name' => 'Kenjayev Yodgor Mamatkulovich', 'phone' => '+998976944480'],
                ['title' => 'Tibbiy profilaktik fanlar', 'name' => 'Xolmurodov Inoyatullo Ismatulloyevich', 'phone' => '+998978500566'],
                ['title' => 'Tibbiy stomatologik fanlar', 'name' => 'Pardayev Anvar Misirovich', 'phone' => '+998915803728'],
                ['title' => 'Tibbiy morfologik fanlar', 'name' => 'Sultonov Ravshan Komiljonovich', 'phone' => '+998945195500'],
                ['title' => 'Tibbiy terapevtik fanlar', 'name' => 'Ruziyev Oybek Avlayevich', 'phone' => '+998906352211'],
                ['title' => 'Tibbiy xirurgik fanlar', 'name' => 'Xudaykulov Babakul Karjavovich', 'phone' => '+998919700070'],
            ],
            'Magistratura' => [
                ['title' => 'Xodimlar', 'name' => 'Magistratura xodimi', 'phone' => '+998900000000'],
            ],
        ];

        $counter = 1;

        foreach ($kafedraData as $fakultet => $kafedras) {
            $dekan = Dekan::where('title', $fakultet)->first();

            if (!$dekan) {
                $this->command->warn("❌ Dekan topilmadi: {$fakultet}");
                continue;
            }

            foreach ($kafedras as $item) {
                $nameParts = explode(' ', $item['name']);
                $email = mb_strtolower($nameParts[0]) . '.' . mb_strtolower($nameParts[1] ?? '') . '@tisu.uz';
                $email = str_replace("'", '', $email);

                $user = User::create([
                    'name' => $item['name'],
                    'email' => "kafedra{$counter}@tisu.uz",
                    'password' => Hash::make('password'),
                    'role' => 'kafedra',
                ]);

                Kafedra::create([
                    'user_id' => $user->id,
                    'dekan_id' => $dekan->id,
                    'title' => $item['title'],
                    'details' => [
                        'phone' => $item['phone'],
                        'room' => 'B-' . $counter,
                    ],
                ]);

                $counter++;
            }
        }

        $this->command->info("✅ {$counter} ta kafedra yaratildi!");
    }
}
