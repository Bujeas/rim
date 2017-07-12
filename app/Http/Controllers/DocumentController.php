<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use app\Document;

class DocumentController extends Controller
{
    public function GET_document(Request $request)
    {
    	if($request->session()->has('user.id'))
        {
        	$document = Document::all();
        	$params = array('document' => $document);

        	return view('pages.document.listDocument', $params);
        }else{
        	$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_newDocument(Request $request)
    {
    	if($request->session()->has('user.id'))
        {
        	return view('pages.document.newDocument');
        }else{
        	$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function POST_newDocument()
    {
    	$documents = new Document;
        $documents->doc_cat    		= Input::get('doc_cat');
        $documents->description 	= Input::get('doc_description');
        $documents->created_by      = Session::get('user.id');
        $documents->save();
        
        $msg = 'New document category successfully created.';
        return redirect()->route('document')->with('STATUS_OK', $msg);
    }

    public function GET_viewDocument(Request $request, $id)
    {
    	if($request->session()->has('user.id'))
        {
        	$documents = Document::where('id', $id)->first();
            $params = array('id' => $id, 'documents' => $documents);

            return view('pages.document.viewDocument', $params);
        }else{
        	$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_updateDocument(Request $request, $id)
    {
    	if($request->session()->has('user.id'))
        {
        	$documents = Document::where('id', $id)->first();
            $params = array('id' => $id, 'documents' => $documents);

            return view('pages.document.editDocument', $params);
        }else{
        	$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function PUT_updateDocument($id)
    {
    	$documents = Document::where('id', $id)->first();
    	// $documents->doc_cat    		= Input::get('doc_cat');
        $documents->description 	= Input::get('doc_description');
        $documents->created_by      = Session::get('user.id');
        $documents->save();

        $msg = 'Selected document category successfully updated.';
        return redirect()->route('document')->with('STATUS_OK', $msg);
    }

    public function DELETE_document($id)
    {
    	$documents = Document::where('id', $id)->first();
        $documents->delete();

        $msg = 'Selected document successfully deleted.';
        return redirect()->route('document')->with('STATUS_OK', $msg);
    }
}
