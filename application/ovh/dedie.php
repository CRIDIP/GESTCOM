<?php


namespace App\ovh;


class dedie
{

    public function search_os($terme){
        $result = array_search($terme, $this->get_os());
        return $result;
    }

    public function search_boot($terme){
        $result = array_search($terme, $this->get_boot());
        return $result;
    }

    public function search_state($terme){
        $result = array_search($terme, $this->get_state());
        return $result;
    }

    public function search_bp($terme){
        $result = array_search($terme, $this->get_type_bp());
        return $result;
    }

    public function search_img_data($terme){
        $result = array_search($terme, $this->datacenter_img());
        return $result;
    }

    public function search_datacenter($terme){
        $result = array_search($terme, $this->liste_datacenter());
        return $result;
    }

    private function get_os(){
        $ovh_os = array(
            "Ubuntu Serveur 14.04 (64Bits) NU"      => "ubuntu1404-server_64",
            "CentOS 6 (64Bits) PLESK 12"            => "centos6-plesk12_64",
            "CentOS 6 (64Bits) NU"                  => "centos6_64",
            "CentOS 6 (64Bits) Distribution OVH"    => "centos6-ovh_64",
            "Xen SERVER 6 (64Bits)"                 => "xenserver6_64",
            "CentOS 5 (64Bits) NU"                  => "centos5_64",
            "CentOS 7 (64Bits) NU"                  => "centos7_64",
            "Ubuntu Server 12.04 (32Bits) NU"       => "ubuntu1204-server_32",
            "Debian 8 (64Bits) PLESK 12.5" => "debian8-plesk125_64",
        );
        return $ovh_os;
    }

    private function get_boot(){
        $ovh_boot = array(
            "Boot from hard drive (no netboot)" => 1,
            "Stable kernel, vanilla - 64bit"    => 6,
            "Experimental Kernel, with GRSec"   => 181,
            "Experimental Kernel, vanilla"      => 182,
            "Stable Kernel, hz1000 - 64bit"     => 7,
            "Testing Kernel, with GRSec"        => 183,
            "Stable Kernel, with GRSec - 64bit" => 14,
            "Testing Kernel, vanilla"           => 184,
            "Customer rescue system (Linux)"    => 22,
            "FreeBSD 10 64bit Rescue"           => 26
        );
        return $ovh_boot;
    }

    private function get_state(){
        $ovh_state = array(
            "<span class='label label-danger'>Erreur</span>" => "error",
            "<span class='label label-danger'>Hack</span>" => "hacked",
            "<span class='label label-danger'>Hacker & Bloquer</span>" => "hackedBlocked",
            "<span class='label label-success'>Normal</span>" => "ok"
        );
        return $ovh_state;
    }

    private function get_type_bp(){
        $ovh_bp = array(
            "Incluse"   => "included",
            "Platinum"  => "platinum",
            "Premium"   => "premium",
            "Standard"  => "standard",
            "Ultimate"  => "ultimate"
        );
        return $ovh_bp;
    }

    private function datacenter_img(){
        $ovh_data_img = array(
            "https://www.ovh.com/manager/dedicated/images/map/BHS.png" => "bhs1",
            "https://www.ovh.com/manager/dedicated/images/map/BHS.png" => "bhs2",
            "https://www.ovh.com/manager/dedicated/images/map/BHS.png" => "bhs3",
            "https://www.ovh.com/manager/dedicated/images/map/BHS.png" => "bhs4",
            "https://www.ovh.com/manager/dedicated/images/map/BHS.png" => "bhs5",
            "https://www.ovh.com/manager/dedicated/images/map/BHS.png" => "bhs6",
            "https://www.ovh.com/manager/dedicated/images/map/DC.png"  => "dc1",
            "https://www.ovh.com/manager/dedicated/images/map/GRA.png" => "gra1",
            "https://www.ovh.com/manager/dedicated/images/map/DC.png"  => "gsw",
            "https://www.ovh.com/manager/dedicated/images/map/DC.png"  => "p19",
            "https://www.ovh.com/manager/dedicated/images/map/RBX.png" => "rbx-hz",
            "https://www.ovh.com/manager/dedicated/images/map/RBX.png" => "rbx1",
            "https://www.ovh.com/manager/dedicated/images/map/RBX.png" => "rbx2",
            "https://www.ovh.com/manager/dedicated/images/map/RBX.png" => "rbx3",
            "https://www.ovh.com/manager/dedicated/images/map/RBX.png" => "rbx4",
            "https://www.ovh.com/manager/dedicated/images/map/RBX.png" => "rbx5",
            "https://www.ovh.com/manager/dedicated/images/map/RBX.png" => "rbx6",
        );
        return $ovh_data_img;
    }

    private function liste_datacenter(){
        $ovh_datacenter = array(
            "Beauharnois 1" => "bhs1",
            "Beauharnois 2" => "bhs2",
            "Beauharnois 3" => "bhs3",
            "Beauharnois 4" => "bhs4",
            "Beauharnois 5" => "bhs5",
            "Beauharnois 6" => "bhs6",
            "Paris (DC)"    => "dc1",
            "Paris (P19)"   => "p19",
            "Paris (GSW)"   => "gsw",
            "Roubaix HZ"   => "rbx-hz",
            "Roubaix 1"   => "rbx1",
            "Roubaix 2"   => "rbx2",
            "Roubaix 3"   => "rbx3",
            "Roubaix 4"   => "rbx4",
            "Roubaix 5"   => "rbx5",
            "Roubaix 6"   => "rbx6",
            "Graveline 1" => "gra1"
        );
        return $ovh_datacenter;
    }
}