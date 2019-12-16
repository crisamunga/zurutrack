<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserInvitation
 *
 * @property int $id
 * @property string $email
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInvitation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInvitation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInvitation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInvitation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInvitation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInvitation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInvitation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserInvitation whereUserId($value)
 * @mixin \Eloquent
 */
class UserInvitation extends Model
{
    //
}
