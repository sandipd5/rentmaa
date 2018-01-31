<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Favoirite;
use App\User;
use Illuminate\Support\Facades\Facade;
use JWTAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use phpDocumentor\Reflection\Types\Null_;
use function Sodium\add;


class FavoiriteController extends Controller
{
    //
      public function getAllFavoirites()
    {
        $favoirites = Favoirite::with('property','user')->get();;
        return $favoirites;
    }
     public function getFavoiriteById(Favoirite $favoirite)
    {
        return $favoirite;
    }
    public function createFavoirite(Request $request)
    {
       
        $user = JWTAuth::toUser(JWTAuth::getToken());
        $property_id = $request->get('property_id');
        $user_id = $request->get('user_id');
        if ($user->id == $user_id) {
            try {
                $property = Property::findOrFail($property_id);
            } catch (ModelNotFoundException $e) {
                return "prperty does not exists";
                //return $this->sendErrorResponse(404, "prperty does not exists");
            }
            $count = Favoirite::where(['user_id' => $user_id, 'property_id' => $property_id])->count();
            if ($count == 0) {
                $property=Property::where('id',$property_id)->first();
                $user->favoirites()->attach($property);
                $interestedCount=$property->people_interested+1;       //adding the count of people interested in property table
                $property->update(['people_interested'=>$interestedCount]);

               
                //return $this->sendSuccessResponse(200, "property Added to user Favourite List");
                   //return $interestedCount;
                   return "success";           
            } 
              else 
              {
                //return $this->sendSuccessResponse(200, "This property has been already added to favoirite");
                return "already added to Favourite";
              }

        } else {
            return "Unauthorized access";
           // return $this->sendErrorResponse(401, "Unauthorized access, User ID doesn't matches with user");
        }
    }
      public function delete($property_id, $user_id)
    {
        $user = JWTAuth::toUser(JWTAuth::getToken());
        if ($user->id == $user_id) {
            try {
                $property = Property::findOrFail($property_id);
            } catch (ModelNotFoundException $e) {
                return "property doesnot exist";
                //return $this->sendErrorResponse(404, "Event does not exists");
            }
            $count=Favoirite::where(['property_id'=>$property_id, 'user_id'=>$user_id])->count();
            if($count!=0){
                $user->favoirites()->detach($property);
                $interestedCount=$property->people_interested-1;       //subtracting the count of people interested in property table
                $property->update(['people_interested'=>$interestedCount]);
                return $interestedCount;
                //return "property Removed from user Favourite List";
               // return $this->sendSuccessResponse(200, "property Removed from user Favourite List");
            }else
                  return "Favourite has already been removed or does not exists"; 
                //return $this->sendErrorResponse(404, "Favourite has already been removed or does not exists");
        } else {
              return "Unauthorized access, User ID doesn't matches with user";
           // return $this->sendErrorResponse(401, "Unauthorized access, User ID doesn't matches with user");
        }
    }



}
