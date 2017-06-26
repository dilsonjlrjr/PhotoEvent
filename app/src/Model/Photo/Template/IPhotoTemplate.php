<?php
/**
 * Created by PhpStorm.
 * User: dilsonrabelo
 * Date: 20/04/16
 * Time: 14:13
 */

namespace App\Model\Photo\Template;


interface IPhotoTemplate
{
    function save($binary);
    function make();
}