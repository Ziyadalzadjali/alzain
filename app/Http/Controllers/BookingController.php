<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Branch;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    /** Slots offered each day. */
    public const SLOTS = ['10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'];

    public function create(Request $request)
    {
        $services = Service::active()->with('category')->get();
        $branches = Branch::active()->get();
        $staff = Staff::active()->get();

        return view('booking.create', [
            'services' => $services,
            'branches' => $branches,
            'staff' => $staff,
            'slots' => self::SLOTS,
            'selectedService' => $request->query('service'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'branch_id' => ['required', 'exists:branches,id'],
            'staff_id' => ['nullable', 'exists:staff,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'in:'.implode(',', self::SLOTS)],
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_phone' => ['required', 'string', 'max:40'],
            'customer_email' => ['nullable', 'email', 'max:160'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $taken = Booking::where('branch_id', $data['branch_id'])
            ->where('date', $data['date'])
            ->where('time', $data['time'])
            ->where('status', '!=', 'cancelled')
            ->when($data['staff_id'] ?? null, fn ($q) => $q->where('staff_id', $data['staff_id']))
            ->exists();

        if ($taken) {
            throw ValidationException::withMessages([
                'time' => __('This slot is no longer available. Please pick another time.'),
            ]);
        }

        $booking = Booking::create($data);

        return redirect()->route('booking.confirmation', $booking->reference);
    }

    public function confirmation(string $reference)
    {
        $booking = Booking::where('reference', $reference)
            ->with(['service', 'branch', 'staff'])
            ->firstOrFail();

        return view('booking.confirmation', compact('booking'));
    }
}
