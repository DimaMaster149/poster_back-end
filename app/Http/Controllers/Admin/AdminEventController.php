<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use DateTime;
use App\Event;
use App\State;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;

class AdminEventController extends Controller
{
	//Для опубликованных событий
	public function publishedAdminEventsEdit($id) {
		$publishedEvent = Event::find($id);
		return response()->json($publishedEvent);
	}

	public function publishedAdminEventsUpdate(Request $request, $id) {
		$file = $request->file('event_image'); //?
		$extension = $file->getClientOriginalName();
		$fileName = time().'_'.$extension;
		$resizedImage = Image::make($file)->resize(640,480);
		$resizedImage->save('images/'.$fileName);
		$userId = Auth::user()->id;

		Event::where('event_id', $id)->update([
			'event_title' =>  $request->input('event_title'),
			'event_description' => $request->input('event_description'),
			'event_state' => 1,
			'event_user' => $userId,
			'event_image' =>$fileName,
			'event_date' => $request->input('event_date'),
			'event_time' => $request->input('event_time'),
			'event_location' => $request->input('event_location'),
		]);
		return redirect('/home');
	}

	public function publishedAdminEventsDelete($id){
		try{
			Event::destroy($id);
			return response([], 204);
		} catch(\Exception $e){
			return response(['Deleting error', 500]);
		}
	}

	//Все предложенные события
	public function proposedAdminEvents() {
		$proposedEvents = Event::orderby('event_id')->where('event_state', 2)->get();
		return response()->json($proposedEvents);
	}

	public function proposedAdminEventsStore(Request $request) {
		$file = $request->file('event_image'); //?
		$extension = $file->getClientOriginalName();
		$fileName = time().'_'.$extension;
		$resizedImage = Image::make($file)->resize(640,480);
		$resizedImage->save('images/'.$fileName);
		$userId = Auth::user()->id;

		$proposedEvent = new Event($request->all());
		$proposedEvent->event_image=$fileName;
		$proposedEvent->event_user = $userId;
		$proposedEvent->event_state=1;
		$proposedEvent->save();
		return response()->json($proposedEvent);
	}

	public function proposedAdminEventsEdit($id) {
		$proposedEvent = Event::find($id);
		return response()->json($proposedEvent);
	}

	public function proposedAdminEventsUpdate(Request $request, $id) {
		$file = $request->file('event_image'); //?
		$extension = $file->getClientOriginalName();
		$fileName = time().'_'.$extension;
		$resizedImage = Image::make($file)->resize(640,480);
		$resizedImage->save('images/'.$fileName);
		$userId = Auth::user()->id;

		Event::where('event_id', $id)->update([
			'event_title' =>  $request->input('event_title'),
			'event_description' => $request->input('event_description'),
			'event_state' => 1,
			'event_user' => $userId,
			'event_image' =>$fileName,
			'event_date' => $request->input('event_date'),
			'event_time' => $request->input('event_time'),
			'event_location' => $request->input('event_location'),
		]);
		return redirect('/home');
	}

	public function proposedAdminEventsDelete($id){
		try{
			Event::destroy($id);
			return response([], 204);
		} catch(\Exception $e){
			return response(['Deleting error', 500]);
		}
	}
}
