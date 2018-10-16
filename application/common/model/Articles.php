<?php
namespace app\common\model;

use think\Model;

class Articles extends Model
{
    protected $pk = 'ArticleID';
    protected $table = 'articles';
    protected $fillable = [];
}