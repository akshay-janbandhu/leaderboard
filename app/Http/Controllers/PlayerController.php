<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Player as PlayerResource;
use App\Http\Resources\PlayerCollection;
use App\Http\Requests\StorePointsRequest;
use App\Services\PlayerManager;

class PlayerController extends Controller
{
    /**
     * Player service
     */
    public $manager;

    /**
     * Constructor
     * 
     * @param \App\PlayerManager $playerManager
     */
    function __construct(PlayerManager $playerManager) {
        $this->manager = $playerManager;
    }

    /**
     * Fetches list of players and associated details
     * 
     * @return \App\Http\Resources\PlayerCollection
     */
    public function index()
    {
        return new PlayerCollection($this->manager->listAll());
    }

    /**
     * Fetches details of a player by identifier
     * 
     * @param integer $id
     * 
     * @return \App\Http\Resources\Player
     */
    public function detail($id)
    {
        return new PlayerResource($this->manager->find($id));
    }

    /**
     * Stores updated points for the player
     * 
     * @param integer $id
     * @param \App\Http\Requests\StorePointsRequest $request
     * 
     * @return \App\Http\Resources\Player
     */
    public function points($id, StorePointsRequest $request)
    {
        try {
            return new PlayerResource(
                $this->manager->storePoints($id, $request)
            );
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occured'], '422');
        }
    }
}
