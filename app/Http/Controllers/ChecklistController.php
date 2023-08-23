<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Item;
use Illuminate\Http\Request;
use Throwable;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Checklist::all();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'name' => 'required',
        ]);

        if (!$validate) {
            return response()->json($validate);
        }

        try {
            $checklist = Checklist::create([
                'name'      => $request->name,
            ]);
            return response()->json($checklist);
        } catch (Throwable $error) {
            return response()->json($error);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Checklist::destroy($id);
            return response()->json($id);
        } catch (Throwable $error) {
            return response()->json($error);
        }
    }

    /**
     * Get All checklist item by checklist id.
     */
    public function item($id)
    {
        try {
            $item  = Checklist::find($id)->items;
            return response()->json($item);
        } catch (Throwable $error) {
            return response()->json($error);
        }
    }

    /**
     * Create new checklist item in checklist
     */
    public function newItem(Request $request, $checklistId)
    {
        $validate = $this->validate($request, [
            'name' => 'required',
        ]);


        if (!$validate) {
            return response()->json($validate);
        }

        try {
            $item  = Item::create([
                'name' => $request->name,
                'checklist_id' => $checklistId
            ]);
            return response()->json($item);
        } catch (Throwable $error) {
            return response()->json($error);
        }
    }

    /**
     * Get checklist item in checklist by checklist id
     */

    public function getCheklistItem($checklistId, $checklistItemId)
    {
        try {
            $item  = Checklist::find($checklistId)->items->where('id', $checklistItemId);
            return response()->json($item);
        } catch (Throwable $error) {
            return response()->json($error);
        }
    }

    public function updateCheklistItem(Request $request, $checklistId, $checklistItemId)
    {
        try {
            $item  = Checklist::find($checklistId)->items->where('id', $checklistItemId);
            $item->name = $request->item;
            return response()->json($item);
        } catch (Throwable $error) {
            return response()->json($error);
        }
    }
    public function deleteCheklistItem($checklistId, $checklistItemId)
    {
        try {
            Item::destroy($checklistItemId);
            return response()->json();
        } catch (Throwable $error) {
            return response()->json($error);
        }
    }
}
