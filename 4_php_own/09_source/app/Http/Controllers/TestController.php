<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\User;

class TestController extends Controller
{
    public function send_data(Request $request)
    {
        $selected_word_info = Word::join('users','users.id','=','words.user_id')
                                ->where('words.id', $request['id'])
                                ->select(
                                        'words.title as title',
                                        'words.detail as detail',
                                        'words.page as page',
                                        'users.name as create_user_name')
                                ->first();
        return $selected_word_info;

    }
}
