<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Ticket::orderBy('id');

        if ($request->q != null) {
            $query->where('name', 'like', '%'.$request->q.'%');
        }

        return inertia('Ticket/Index', [
            'tickets' => $query->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|max:999999|min:1'
        ]);

        Ticket::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('tickets.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|max:999999|min:1'
        ]);

        $ticket->update($request->only(['name', 'price']));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back();
    }
}
