<?php
use App\Area;
use App\Image;
use App\Property;
//use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;


class ImagesController extends Controller
{
    public function upload(Request $request)
    {
        return 'HEllo';
       $rules = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';

        $file_names = [];
        if ($request->hasFile('input_img')) {
            $images = $request->file('input_img');
            if (is_array($images)) {
                for ($i = 0; $i < count($images); $i++) {
//                    $validator = Validator::make($images[$i], $rules);
//                    if ($validator->fails()) {
//                        $error = $validator->messages()->toJson();
//                        return response()->json(['success' => false, 'message' => $error]);
//                    }

                    $name = time() . '_' . $i . '.' . $images[$i]->getClientOriginalExtension();
                    $destinationPath = public_path('/images');
                    $images[$i]->move($destinationPath, $name);
                    array_push($file_names, url('/') . '/images/' . $name);
                }
            } else {
                        $this->validate($request, [
                       'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                       ]);
                $name = time() . '.' . $images->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $images->move($destinationPath, $name);
                array_push($file_names, url('/') . '/images/' . $name);
            }

            return response()->json([
                'success' => true,
                'message' => 'Images Uploaded Successfully',
                'images' => $file_names
            ]);
        }
    }

    public function linkImageWithProperty($images, $id)
    {
        $property = Property::find($id);
        if (!is_null($property)) 
        {
            $alt = $this->getPropertyTag($property);
            $thumbnail = false;
            for ($i = 0; $i < count($images); $i++) 
            {
                if ($i == 0)
                    $thumbnail = true;
                Image::create([
                    'property_id' => $id,
                    'alt' => $alt,
                    'url' => $images[$i],
                    'thumbnail' => $thumbnail
                   ]);
               $thumbnail = false;
            }
        } else 
        {
            return "property not found";
            
        }

    }

    public function addImagesToProperty(Request $request)
    {
        $images = $request->images;
        $id = $request->property_id;
        $property = Property::find($id);
        $addedImages=[];
        if (!is_null($property)) {
            $alt = $this->getPropertyTag($property);
            for ($i = 0; $i < count($images); $i++) {
                $image=Image::create([
                    'property_id' => $id,
                    'alt' => $alt,
                    'url' => $images[$i],
                    'thumbnail' => false
                ]);
                $addedImages[]=$image;
            }
            return $addedImages;
        } else {
            return $this->sendErrorResponse(404, "Property not found");
        }
    }

    public function getPropertyTag($property)
    {
        $category = $property->category->title;
        $status = $property->status;
        $area = Area::find($property->area_id);
        $alt = $category . " property on" . $status . " at " . $area->name;
        return $alt;
    }

    public function deletePropertyImage(Image $image)
    {
        $image_path=$image->url;
        if ($image->delete()) {
            $this->deleteImageFromServer($image_path);
            return $this->sendSuccessResponse(200, "Image Deleted Successfully");
        }
    }

    public function deleteImageFromServer($file_path){
        print_r(basename($file_path));
        $destinationPath = public_path('/images/'.basename($file_path));
        if(file_exists($destinationPath)){
            @unlink($destinationPath);
        }
    }
}
