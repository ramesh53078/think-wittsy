<?php

namespace App\Http\Controllers\Admin;

use App\Admin\UnitSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UnitSettingController extends Controller
{
    public function updateSettings(Request $request)
    {
        if($request->color) {

            $validator = Validator::make($request->all(), [
                'color' => 'required|in:blue,green,primary,dark',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $data = UnitSetting::where('id',1)->update([
                'sidebar_background' => $request->color
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Sidebar settings updated successfully'
            ]);
        }

        if($request->bodyColor) {

            $validator = Validator::make($request->all(), [
                'bodyColor' => 'required|in:dark-content,white-content',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $data = UnitSetting::where('id',1)->update([
                'panel_background' => $request->bodyColor
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Panel Settings updated successfully'
            ]);
        }
    }
}
