<?php
namespace App\Library;


use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostLike;
use App\Models\User;
use App\Models\UserDirectMessage;
use App\Models\UserFollowing;
use Auth;


class sHelper
{

    static $notifications = null;



    public static function followButton($following, $follower, $element, $size = ''){

        if ($following  == $follower) return "Este soy yo";

        $relation = UserFollowing::where('following_user_id', $following)->where('follower_user_id', $follower)->get()->first();

        if ($relation){
            if ($relation->allow == 0) {
                return '<a href="javascript:;" class="btn btn-default request-button '.$size.'" onclick="follow(' . $following . ', ' . $follower . ', \''.$element.'\', \''.$size.'\')"></a>';
            }elseif ($relation->allow == 1){
                return '<a href="javascript:;" class="btn btn-default following-button '.$size.'" onclick="follow('.$following.', '.$follower.', \''.$element.'\', \''.$size.'\')"></a>';
            }
        }

        return '<a href="javascript:;" class="btn btn-default follow-button '.$size.'" onclick="follow('.$following.', '.$follower.', \''.$element.'\', \''.$size.'\')"><i class="fa fa-plus-circle"></i> Follow</a>';

    }


    public static function deniedButton($me, $follower, $element, $size = ''){
        if ($me  == $follower) return "";

        $relation = UserFollowing::where('following_user_id', $me)->where('follower_user_id', $follower)->get()->first();

        if ($relation){
            if ($relation->allow == 1) {
                return '<a href="javascript:;" class="btn btn-danger '.$size.'" onclick="deniedFollow('.$me.', '.$follower.', \''.$element.'\', \''.$size.'\')" data-toggle="tooltip" title="Block">
                <i class="fa fa-times"></i>
                </a>';
            }
        }
    }


    // public static function distance($lat1, $lon1, $lat2, $lon2) {
    //
    //     $theta = $lon1 - $lon2;
    //     $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    //     $dist = acos($dist);
    //     $dist = rad2deg($dist);
    //     $miles = $dist * 60 * 1.1515;
    //
    //     $km = $miles * 1.609344;
    //
    //     if ($km < 1){
    //         return round($miles * 1609.344).' Meter';
    //     }
    //
    //     return round($km, 2).' Km';
    //
    // }

    public static function notifications(){
        if (self::$notifications == null){
            $notifications = [];

            $user = Auth::user();
            //anda si pones tu cuenta en privada
            $followers = $user->follower()->where('allow', 0)->count();
            if ($followers > 0){
                $notifications[] = [
                    'url' => url('/followers/pending'),
                    'icon' => 'fa-user-plus',
                    'text' => $followers.' Solicitud de seguidores'
                ];
            }


            //anda
            $relatives = $user->relatives()->where('allow', 0)->count();
            // dd($relatives);
            if ($relatives > 0){
                $notifications[] = [
                    'url' => url('/relatives/pending'),
                    'icon' => 'fa-user-circle-o',
                    'text' => $relatives.' Alguien quiere agregarte a su circulo'
                ];
            }



            $comments = PostComment::where('seen', 0)->with('user')->join('posts', 'posts.id', '=', 'post_comments.post_id')->where('posts.user_id', $user->id)->where('comment_user_id', '!=', $user->id)->join('users','users.id', '=' ,'comment_user_id')->select('post_comments.*','users.name')->orderBy('post_comments.post_id', 'ASC');

            // dd($comments->count());
            if ($comments->count() > 0){
                foreach ($comments->get() as $comment){
                    $notifications[] = [
                        'url' => url('/post/'.$comment->post_id),
                        'icon' => 'fa-commenting',
                        'text' => 'Recibiste un comentario en tu post de '.$comment->name,

                    ];
                }

            }


            // $hashtag = PostComment::where('seen', 0)->with('user')->join('posts', 'posts.id', '=', 'post_comments.post_id')->where('posts.user_id', $user->id)->where('comment_user_id', '!=', $user->id)->join('users','users.id', '=' ,'comment_user_id')->select('post_comments.*','users.name')->orderBy('post_comments.post_id', 'ASC');







        $likes =PostLike::where('seen', 0)->with('user')->join('posts', 'posts.id', '=', 'post_likes.post_id')->where('posts.user_id', $user->id)->join('users','users.id', '=' ,'like_user_id')->where('like_user_id', '!=', $user->id)->select('post_likes.*','users.name')->orderBy('post_likes.post_id', 'ASC');

            if ($likes->count() > 0){
                foreach ($likes->get() as $likne){
                    $notifications[] = [
                        'url' => url('/post/'.$likne->post_id),
                        'icon' => 'fa-heart',
                        'text' => 'Recibiste un like en tu post de '.$likne->name
                    ];

                  }
            }
            $messages =UserDirectMessage::where('seen', 0)->with('receiver')->join('users', 'users.id', '=', 'user_direct_messages.sender_user_id')->where('user_direct_messages.receiver_user_id', $user->id)->where('user_direct_messages.sender_user_id', '!=', $user->id)->select('message', 'sender_user_id', 'users.name')->orderBy('sender_user_id', 'ASC') ;
            if ($messages->count() >0 ) {
              foreach ($messages->get() as $message){
                  $notifications[] = [
                      'url' => url('/direct-messages/show/'.$message->sender_user_id ), //hacer vista de messages para cada uno
                      'icon' => 'fa-envelope',
                      'text' => 'Recibiste un mensaje de '. $message->name
                  ];

            }
             }


            self::$notifications = $notifications;

        }

        return self::$notifications;
    }




}
