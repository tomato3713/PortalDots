<?php

namespace App\Http\Controllers\Contacts;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Eloquents\Circle;
use App\Eloquents\ContactCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Services\Contacts\ContactsService;

class PostAction extends Controller
{
    private $contactsService;

    public function __construct(ContactsService $contactsService)
    {
        $this->contactsService = $contactsService;
    }

    public function __invoke(ContactFormRequest $request)
    {
        // ユーザーが企画に所属しているかどうかの検証は
        // ContactFormRequest で行っている
        $circle = !empty($request->circle_id) ? Circle::find($request->circle_id) : null;
        $sender = Auth::user();
        $category =
            ContactCategory::find($request->category) ??
            new ContactCategory([
                'email' => config('portal.contact_email'),
                'name' => config('portal.admin_name'),
            ]);

        $this->contactsService->create($circle, $sender, $request->contact_body, $category);

        return redirect()
            ->route('contacts')
            ->with('topAlert.title', 'お問い合わせを受け付けました。')
            ->with('topAlert.body', new HtmlString(nl2br(e($request->contact_body))));
    }
}
