<?php
/**
 * Created by PhpStorm.
 * User: SWD
 * Date: 04/03/2016
 * Time: 13:06
 */

namespace App\general;


class insert
{
    public function breadcumb($view, $sub, $data)
    {
        if(empty($sub) AND empty($data)){
            $html = '
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li><a href="index.php?view=index">'.constante::NOM_SITE.'</a>
                        </li>
                        <li class="active">'.$view.'</li>
                    </ol>
                </div>
            ';
            return $html;
        }elseif(empty($data)){
            $html = '
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li><a href="index.php?view=index">'.constante::NOM_SITE.'</a>
                        </li>
                        <li>
                            <a href="">'.$view.'</a>
                        </li>
                        <li class="active">'.$sub.'</li>
                    </ol>
                </div>
            ';
            return $html;
        }else{
            $html = '
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li><a href="index.php?view=index">'.constante::NOM_SITE.'</a>
                        </li>
                        <li>
                            <a href="">'.$view.'</a>
                        </li>
                        <li>
                            <a href="">'.$sub.'</a>
                        </li>
                        <li class="active">'.$data.'</li>
                    </ol>
                </div>
            ';
            return $html;
        }
    }
}