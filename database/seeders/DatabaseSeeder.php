<?php

namespace Database\Seeders;

use App\Models\Config;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public User $user;

    public function run(): void
    {
        $this->userSeed();
        $this->subscriptionsSeed();
//        dd($this->user->id);
        $this->configsSeed();
    }

    public function userSeed()
    {
        $this->user = User::query()
                          ->firstOrCreate([
                                              'wallet_address' => 'UQBEkOMLTHMkDWOPIoMvbXdUMiwgTh7Tk1D7F9ZtrrbS4q2i',
                                              'public_key'     => 'test'
                                          ]);
    }

    public function subscriptionsSeed()
    {
        Subscription::query()
                    ->firstOrCreate([
                                        'expiration' => 30,
                                        'size'       => 30,
                                        'price'      => 1.99
                                    ]);
        Subscription::query()
                    ->firstOrCreate([
                                        'expiration' => 30,
                                        'size'       => 60,
                                        'price'      => 15.99
                                    ]);
        Subscription::query()
                    ->firstOrCreate([
                                        'expiration' => 30,
                                        'size'       => 100,
                                        'price'      => 28.99
                                    ]);
    }

    public function configsSeed()
    {
        $locations = [
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'United Arab Emirates',
                'location'    => 'Dubai',
                'countryFlag' => 'storage/openvpn/AE/A1383376600.jpg',
                'configFile'  => 'storage/openvpn/AE/AE_vpn482908711.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'United Arab Emirates',
                'location'    => 'Dubai',
                'countryFlag' => 'storage/openvpn/AE/A1383376600.jpg',
                'configFile'  => 'storage/openvpn/AE/AE_vpn482908711.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'United Arab Emirates',
                'location'    => 'Dubai',
                'countryFlag' => 'storage/openvpn/AE/A1383376600.jpg',
                'configFile'  => 'storage/openvpn/AE/AE_wams.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'Australia',
                'location'    => 'Sydney',
                'countryFlag' => 'storage/openvpn/AU/150x90-australia-flag3-OPTIMIZED.jpg',
                'configFile'  => 'storage/openvpn/AU/AU_vpn181866999.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'Canada',
                'location'    => 'Ottawa',
                'countryFlag' => 'storage/openvpn/CA/images.jpeg',
                'configFile'  => 'storage/openvpn/CA/CA_vpn137292210.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'Canada',
                'location'    => 'Ottawa',
                'countryFlag' => 'storage/openvpn/CA/images.jpeg',
                'configFile'  => 'storage/openvpn/CA/CA_vpn748313328.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'Germany',
                'location'    => 'Berlin',
                'countryFlag' => 'storage/openvpn/DE/Flag_of_Germany.svg.png',
                'configFile'  => 'storage/openvpn/DE/DE_vpn408213436.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'Germany',
                'location'    => 'Berlin',
                'countryFlag' => 'storage/openvpn/DE/Flag_of_Germany.svg.png',
                'configFile'  => 'storage/openvpn/DE/DE_vpn836610036.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'Germany',
                'location'    => 'Berlin',
                'countryFlag' => 'storage/openvpn/DE/Flag_of_Germany.svg.png',
                'configFile'  => 'storage/openvpn/DE/DE_vpn779138305.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'United Kingdom',
                'location'    => 'London',
                'countryFlag' => 'storage/openvpn/GB/Flag_of_the_United_Kingdom_(3-5).svg.png',
                'configFile'  => 'storage/openvpn/GB/GB_vpn227320697.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'South Korea',
                'location'    => 'Seoul',
                'countryFlag' => 'storage/openvpn/KR/import-flag-south-korea1-150x90.jpg',
                'configFile'  => 'storage/openvpn/KR/KR_vpn304549449.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'Thailand',
                'location'    => 'Bangkok',
                'countryFlag' => 'storage/openvpn/TH/Flag_of_Costa_Rica.svg.png',
                'configFile'  => 'storage/openvpn/TH/TH_vpn419711180.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'United State',
                'location'    => 'New York',
                'countryFlag' => 'storage/openvpn/US/t_flagusa28s.jpg',
                'configFile'  => 'storage/openvpn/US/US_vpn896793453.ovpn',
                'type'        => 'ovpn'
            ],
            [
                'special'     => false,
                'active'      => true,
                'country'     => 'Japan',
                'location'    => 'Tokyo',
                'countryFlag' => 'storage/openvpn/JP/JP-flag.jpg',
                'configFile'  => 'storage/openvpn/JP/JP_vpn706006471.ovpn',
                'type'        => 'ovpn'
            ],
        ];
        foreach ($locations as $location) {
            $a[]=Config::query()->firstOrCreate($location);
        }
        dd($a);
    }
}
