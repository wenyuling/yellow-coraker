<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

/**
 * 订单支付成功给用户发送邮件通知类
 * Class OrderPaidNotification
 * @package App\Notifications
 */
class OrderPaidNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     * 我们只需要通过邮件通知，因此这里只需要一个 mail 即可
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('订单支付成功')  // 邮件标题
            ->greeting($this->order->user->name.'您好：') // 欢迎词
            ->line('您于 '.$this->order->created_at->format('m-d H:i').' 创建的订单已经支付成功。') // 邮件内容
            ->action('查看订单', route('orders.show', [$this->order->id])) // 邮件中的按钮及对应链接
            ->success(); // 按钮的色调
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
