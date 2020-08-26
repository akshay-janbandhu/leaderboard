<?php

namespace App\Services;

use App\Player;
use DB;

class PlayerManager
{
    /**
     * List all filters
     * 
     * @param array $filters Not used
     * 
     * @return array
     */
    public function listAll(array $filters = [])
    {
        return Player::active()
            ->orderBy('points', 'DESC')
            ->orderBy('first_name', 'ASC')
            ->get()
            ->all();
    }

    /**
     * Find player details by identifier
     * 
     * @param integer $id
     * 
     * @return \App\Player
     */
    public function find($id)
    {
        return Player::findOrFail($id);
    }

    /**
     * Store points for a user
     * 
     * @param integer $id    Player identifier
     * @param array   $input Update information
     * 
     * @return \App\Player
     */
    function storePoints($id, $input) {
        DB::transaction(function () use ($id, $input) {
            $player = $this->find($id);
    
            if (isset($input['action']) && $input['action'] == 'increment') {
                $points = $player->points + 1;
            } else {
                $points = $player->points - 1;
            }
    
            Player::find($id)
                ->update([
                    'points' => (int) $points
                ]);
        }, 5);

        return $this->find($id);
    }
}
