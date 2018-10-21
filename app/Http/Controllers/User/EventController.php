<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use DateTime;
use App\Event;
use App\State;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as Image;


class EventController extends Controller
{
    //Список опубликованных ивентов на сегодня
	public function publishedEvents() {
		$date = new DateTime();
		$publishedEvents = Event::orderby('event_id')->where('event_state', 1)->where('event_date', $date->format('Y-m-d'))->get();
		return response()->json($publishedEvents);
	}
	//Список опубликованных ивентов по выбранной дате
	public function publishedEventsSearch(Request $request) {
		$events = Event::orderby('event_id')->where('event_state', 1)->where('event_date', $request->event_date)->get();
		return response()->json($events);
	}
	//Список предложенных ивентов определенным пользователем
	public function proposedEvents() {
		$userId = Auth::user()->id;
		$proposedEvents = Event::orderby('event_id')->where('event_state', 2)->where('event_user', $userId)->get();
		return response()->json($proposedEvents);
	}
	//Добавление, редактирование и удаление предолженны событий определенным пользователем
	public function proposedEventsStore(Request $request) {
		$file = $request->file('event_image'); //?
		$extension = $file->getClientOriginalName();
		$fileName = time().'_'.$extension;
		$resizedImage = Image::make($file)->resize(640,480);
		$resizedImage->save('images/'.$fileName);

		$proposedEvent = new Event($request->all());
		$proposedEvent->event_image=$fileName;
		$proposedEvent->save();
		return response()->json($proposedEvent);
	}

	public function proposedEventsEdit($id) {
		$proposedEvent = Event::find($id);
		return response()->json($proposedEvent);
	}

	public function proposedEventsUpdate(Request $request, $id) {
		$file = $request->file('event_image'); //?
		$extension = $file->getClientOriginalName();
		$fileName = time().'_'.$extension;
		$resizedImage = Image::make($file)->resize(640,480);
		$resizedImage->save('images/'.$fileName);
		$userId = Auth::user()->id;

		Event::where('event_id', $id)->update([
			'event_title' =>  $request->input('event_title'),
			'event_description' => $request->input('event_description'),
			'event_state' => 2,
			'event_user' => $userId,
			'event_image' =>$fileName,
			'event_date' => $request->input('event_date'),
			'event_time' => $request->input('event_time'),
			'event_location' => $request->input('event_location'),
		]);
		return redirect('/home');
	}

	public function proposedEventsDelete($id){
		try{
			Event::destroy($id);
			return response([], 204);
		} catch(\Exception $e){
			return response(['Deleting error', 500]);
		}
	}
}
