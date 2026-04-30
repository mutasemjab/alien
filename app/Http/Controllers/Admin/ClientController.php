<?php
// ============================================================
// ClientController
// ============================================================
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('sort_order')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.form', ['client' => new Client()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile('logo')) {
            $data['logo'] =  uploadImage('assets/admin/uploads', $request->logo);
        }
        Client::create($data);
        return redirect()->route('admin.clients.index')
            ->with('success', __('admin.created_successfully'));
    }

    public function edit(Client $client)
    {
        return view('admin.clients.form', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $this->validated($request);
        if ($request->hasFile('logo')) {
            $data['logo'] = uploadImage('assets/admin/uploads', $request->logo);
        }
        $client->update($data);
        return redirect()->route('admin.clients.index')
            ->with('success', __('admin.updated_successfully'));
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return back()->with('success', __('admin.deleted_successfully'));
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'logo'        => 'nullable|image|max:2048',
            'website_url' => 'nullable|url|max:200',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}