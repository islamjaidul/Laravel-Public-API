<?php

namespace App\v1\User\Responder\Transformers;

use League\Fractal\TransformerAbstract;

class AllUserTransformer extends TransformerAbstract
{
	public function transform(array $user) : array
	{
		$user = (object) $user;

		return [
			'id'							=> $user->id,
			'organization_id'				=> $user->organization_id,
			'login' 						=> $user->login,
			'firstname' 					=> $user->firstname,
			'lastname' 						=> $user->lastname,
			'email' 						=> $user->email,
			'image' 						=> $user->image,
			'image_source' 					=> $user->image_source,
			'web' 							=> $user->web,
			'phone' 						=> $user->phone,
			'fax' 							=> $user->fax,
			'mobile' 						=> $user->mobile,
			'department' 					=> $user->department,
			'street' 						=> $user->street,
			'zip' 							=> $user->zip,
			'city' 							=> $user->city,
			'country' 						=> $user->country,
			'address' 						=> $user->address,
			'vip' 							=> $user->vip,
			'verified' 						=> $user->verified,
			'active' 						=> $user->active,
			'note' 							=> $user->note,
			'last_login' 					=> $user->last_login,
			'source' 						=> $user->source,
			'login_failed' 					=> $user->login_failed,
			'out_of_office' 				=> $user->out_of_office,
			'out_of_office_start_at' 		=> $user->out_of_office_start_at,
			'out_of_office_end_at' 			=> $user->out_of_office_end_at,
			'out_of_office_replacement_id' 	=> $user->out_of_office_replacement_id,
			'preferences' 					=> $user->preferences,
			'updated_by_id' 				=> $user->updated_by_id,
			'created_by_id' 				=> $user->created_by_id,
			'created_at' 					=> $user->created_at,
			'updated_at' 					=> $user->updated_at,
			'role_ids' 						=> $user->role_ids,
			'organization_ids' 				=> $user->organization_ids,
			'authorization_ids' 			=> $user->authorization_ids,
			'karma_user_ids' 				=> $user->karma_user_ids,
			'group_ids' 					=> $user->group_ids,
			// 'accounts' 					=> $user->accounts
		];
	}
}