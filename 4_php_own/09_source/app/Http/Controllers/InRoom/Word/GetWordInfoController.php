<?php

namespace App\Http\Controllers\InRoom\Word;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Word;

class GetWordInfoController extends Controller
{
    public function getWordInfo(Request $request)
    {
        $selected_word_info = Word::join('users','users.id','=','words.user_id')
                                ->where('words.id', $request['selected_word_id'])
                                ->select(
                                        'words.title as title',
                                        'words.detail as detail',
                                        'words.section_index as section_index',
                                        'words.page as page',
                                        'users.name as create_user_name')
                                ->first();
        return $selected_word_info;
    }
}
