<?php

namespace MovieChill\app\Controllers;

use App\Http\Controllers\Controller;
use MovieChill\app\Models\Member;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MyLoveController extends Controller
{

    public function index(): View
    {
        $members = $this->query()->whereIn('id', [1,2] )->get()->toArray();
        return view('admin.pages.myLove.index', compact('members'));
    }

    public function listUser(): View
    {
        $members = $this->query()->get();
        return view('admin.pages.myLove.list-member', compact('members'));
    }

    public function getMember($id): View
    {
        $member = $this->getMemberById($id);
        return view('admin.pages.myLove.edit-member', compact('member'));
    }

    public function editMember(Request $request, $id)
    {
        $image = $request->file('image');
        $data = $request->all();
        if (!empty($image)) {
            $data['image'] = $request->file('image')->getClientOriginalName();
        }
        unset($data['_token']);

        if ($this->getMemberById($id)->update($data)) {
            $request->file('image')->move('assets/myLove/images', $request->file('image')->getClientOriginalName());
        };
        return redirect()->route('list-member');
    }

    private function query(): Builder
    {
        return Member::query();
    }

    private function getMemberById($id)
    {
        return $this->query()->find($id);
    }
}
