<?php

namespace WeStacks\TeleBot;

use WeStacks\TeleBot\Exception\TeleBotObjectException;
use WeStacks\TeleBot\Objects\BotCommand;
use WeStacks\TeleBot\Objects\Update;
use WeStacks\TeleBot\Traits\HasTelegramMethods;
use GuzzleHttp\Promise\PromiseInterface;
use WeStacks\TeleBot\Objects\Chat;
use WeStacks\TeleBot\Objects\ChatMember;
use WeStacks\TeleBot\Objects\ChatInviteLink;
use WeStacks\TeleBot\Objects\File;
use WeStacks\TeleBot\Objects\Games\GameHighScore;
use WeStacks\TeleBot\Objects\Message;
use WeStacks\TeleBot\Objects\Poll;
use WeStacks\TeleBot\Objects\Stickers\StickerSet;
use WeStacks\TeleBot\Objects\User;
use WeStacks\TeleBot\Objects\UserProfilePhotos;
use WeStacks\TeleBot\Objects\WebhookInfo;
use WeStacks\TeleBot\Objects\MessageId;

/**
 * Bot manager for comfortable management of multiple TeleBot instances.
 * 
 * @method Array<BotCommand>|false|PromiseInterface    getMyCommands(array $parameters = [])                   Use this method to get the current list of the bot's commands. Requires no parameters. Returns Array of BotCommand on success.
 * @method Array<ChatMember>|false|PromiseInterface    getChatAdministrators(array $parameters = [])           Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots. If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
 * @method Array<GameHighScore>|false|PromiseInterface getGameHighScores(array $parameters = [])               Use this method to get data for high score tables. Will return the score of the specified user and several of their neighbors in a game. On success, returns an Array of GameHighScore objects.
 * @method ChatMember|false|PromiseInterface           getChatMember(array $parameters = [])                   Use this method to get information about a member of a chat. Returns a ChatMember object on success.
 * @method Chat|false|PromiseInterface                 getChat(array $parameters = [])                         Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
 * @method false|File|PromiseInterface                 getFile(array $parameters = [])                         Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
 * @method false|int|PromiseInterface                  getChatMembersCount(array $parameters = [])             Use this method to get the number of members in a chat. Returns Int on success.
 * @method false|int|PromiseInterface                  getChatMemberCount(array $parameters = [])             Use this method to get the number of members in a chat. Returns Int on success.
 * @method boolean|Message|PromiseInterface            editMessageCaption(array $parameters = [])              Use this method to edit captions of messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method boolean|Message|PromiseInterface            editMessageLiveLocation(array $parameters = [])         Use this method to edit live location messages. A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method boolean|Message|PromiseInterface            editMessageMedia(array $parameters = [])                Use this method to edit animation, audio, document, photo, or video messages. If a message is a part of a message album, then it can be edited only to a photo or a video. Otherwise, message type can be changed arbitrarily. When inline message is edited, new file can't be uploaded. Use previously uploaded file via its file_id or specify a URL. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method boolean|Message|PromiseInterface            editMessageReplyMarkup(array $parameters = [])          Use this method to edit only the reply markup of messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method boolean|Message|PromiseInterface            editMessageText(array $parameters = [])                 Use this method to edit text and game messages. On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method false|Message|PromiseInterface              forwardMessage(array $parameters = [])                  Use this method to forward messages of any kind. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendAnimation(array $parameters = [])                   Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
 * @method false|Message|PromiseInterface              sendAudio(array $parameters = [])                       Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future. For sending voice messages, use the sendVoice method instead.
 * @method false|Message|PromiseInterface              sendContact(array $parameters = [])                     Use this method to send phone contacts. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendDice(array $parameters = [])                        Use this method to send an animated emoji that will display a random value. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendDocument(array $parameters = [])                    Use this method to send general files. On success, the sent Message is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
 * @method false|Message|PromiseInterface              sendGame(array $parameters = [])                        Use this method to send a game. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendInvoice(array $parameters = [])                     Use this method to send invoices. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendLocation(array $parameters = [])                    Use this method to send point on the map. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendMediaGroup(array $parameters = [])                  Use this method to send a group of photos or videos as an album. On success, an array of the sent Messages is returned.
 * @method false|Message|PromiseInterface              sendMessage(array $parameters = [])                     Use this method to send text messages. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendPhoto(array $parameters = [])                       Use this method to send photos. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendPoll(array $parameters = [])                        Use this method to send a native poll. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendSticker(array $parameters = [])                     Use this method to send static .WEBP or animated .TGS stickers. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendVenue(array $parameters = [])                       Use this method to send information about a venue. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendVideo(array $parameters = [])                       Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document). On success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
 * @method false|Message|PromiseInterface              sendVideoNote(array $parameters = [])                   As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long. Use this method to send video messages. On success, the sent Message is returned.
 * @method false|Message|PromiseInterface              sendVoice(array $parameters = [])                       Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as Audio or Document). On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
 * @method boolean|Message|PromiseInterface            setGameScore(array $parameters = [])                    Use this method to set the score of the specified user in a game. On success, if the message was sent by the bot, returns the edited Message, otherwise returns True. Returns an error, if the new score is not greater than the user's current score in the chat and force is False.
 * @method boolean|Message|PromiseInterface            stopMessageLiveLocation(array $parameters = [])         Use this method to stop updating a live location message before live_period expires. On success, if the message was sent by the bot, the sent Message is returned, otherwise True is returned.
 * @method false|Poll|PromiseInterface                 stopPoll(array $parameters = [])                        Use this method to stop a poll which was sent by the bot. On success, the stopped Poll with the final results is returned.
 * @method false|PromiseInterface|StickerSet           getStickerSet(array $parameters = [])                   Use this method to get a sticker set. On success, a StickerSet object is returned.
 * @method false|PromiseInterface|string               exportChatInviteLink(array $parameters = [])            Use this method to generate a new invite link for a chat; any previously generated link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns the new invite link as String on success.
 * @method false|PromiseInterface|true                 addStickerToSet(array $parameters = [])                 Use this method to add a new sticker to a set created by the bot. You must use exactly one of the fields png_sticker or tgs_sticker. Animated stickers can be added to animated sticker sets and only to them. Animated sticker sets can have up to 50 stickers. Static sticker sets can have up to 120 stickers. Returns True on success.
 * @method false|PromiseInterface|true                 answerCallbackQuery(array $parameters = [])             Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, True is returned.
 * @method false|PromiseInterface|true                 answerPreCheckoutQuery(array $parameters = [])          Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query. Use this method to respond to such pre-checkout queries. On success, True is returned. Note: The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
 * @method false|PromiseInterface|true                 answerShippingQuery(array $parameters = [])             If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries. On success, True is returned.
 * @method false|PromiseInterface|true                 createNewStickerSet(array $parameters = [])             Use this method to create a new sticker set owned by a user. The bot will be able to edit the sticker set thus created. You must use exactly one of the fields png_sticker or tgs_sticker. Returns True on success.
 * @method false|PromiseInterface|true                 deleteChatPhoto(array $parameters = [])                 Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method false|PromiseInterface|true                 deleteChatStickerSet(array $parameters = [])            Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
 * @method false|PromiseInterface|true                 deleteMessage(array $parameters = [])                   Use this method to delete a message, including service messages. Returns True on success.
 * @method false|PromiseInterface|true                 deleteStickerFromSet(array $parameters = [])            Use this method to delete a sticker from a set created by the bot. Returns True on success.
 * @method false|PromiseInterface|true                 deleteWebhook()                                         Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success. Requires no parameters.
 * @method false|PromiseInterface|true                 kickChatMember(array $parameters = [])                  Use this method to kick a user from a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method false|PromiseInterface|true                 banChatMember(array $parameters = [])                  Use this method to kick a user from a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method false|PromiseInterface|true                 leaveChat(array $parameters = [])                       Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
 * @method false|PromiseInterface|true                 pinChatMessage(array $parameters = [])                  Use this method to pin a message in a group, a supergroup, or a channel. The bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in the supergroup or 'can_edit_messages' admin right in the channel. Returns True on success.
 * @method false|PromiseInterface|true                 promoteChatMember(array $parameters = [])               Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Pass False for all boolean parameters to demote a user. Returns True on success.
 * @method false|PromiseInterface|true                 restrictChatMember(array $parameters = [])              Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate admin rights. Pass True for all permissions to lift restrictions from a user. Returns True on success.
 * @method false|PromiseInterface|true                 sendChatAction(array $parameters = [])                  Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns True on success.
 * @method false|PromiseInterface|true                 setChatAdministratorCustomTitle(array $parameters = []) Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns True on success.
 * @method false|PromiseInterface|true                 setChatDescription(array $parameters = [])              Use this method to change the description of a group, a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method false|PromiseInterface|true                 setChatPermissions(array $parameters = [])              Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members admin rights. Returns True on success.
 * @method false|PromiseInterface|true                 setChatPhoto(array $parameters = [])                    Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method false|PromiseInterface|true                 setChatStickerSet(array $parameters = [])               Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
 * @method false|PromiseInterface|true                 setChatTitle(array $parameters = [])                    Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method false|PromiseInterface|true                 setMyCommands(array $parameters = [])                   Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users. Returns True on success.
 * @method false|PromiseInterface|true                 deleteMyCommands(array $parameters = [])                Use this method to change the list of the bot's commands. Returns True on success.
 * @method false|PromiseInterface|true                 setPassportDataErrors(array $parameters = [])           Informs a user that some of the Telegram Passport elements they provided contains errors. The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change). Returns True on success. Use this if the data submitted by the user doesn't satisfy the standards your service requires for any reason. For example, if a birthday date seems invalid, a submitted document is blurry, a scan shows evidence of tampering, etc. Supply some details in the error message to make sure the user knows how to correct the issues.
 * @method false|PromiseInterface|true                 setStickerPositionInSet(array $parameters = [])         Use this method to move a sticker in a set created by the bot to a specific position. Returns True on success.
 * @method false|PromiseInterface|true                 setStickerSetThumb(array $parameters = [])              Use this method to set the thumbnail of a sticker set. Animated thumbnails can be set for animated sticker sets only. Returns True on success.
 * @method false|PromiseInterface|true                 setWebhook(array $parameters = [])                      Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns True on success.
 * @method false|PromiseInterface|true                 unbanChatMember(array $parameters = [])                 Use this method to unban a previously kicked user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. Returns True on success.
 * @method false|PromiseInterface|true                 unpinChatMessage(array $parameters = [])                Use this method to unpin a message in a group, a supergroup, or a channel. The bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in the supergroup or 'can_edit_messages' admin right in the channel. Returns True on success.
 * @method false|PromiseInterface|Update[]             getUpdates(array $parameters = [])                      Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned.
 * @method false|PromiseInterface|UserProfilePhotos    getUserProfilePhotos(array $parameters = [])            Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
 * @method false|PromiseInterface|User                 getMe()                                                 A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in form of a User object.
 * @method false|PromiseInterface|WebhookInfo          getWebhookInfo()                                        Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If the bot is using getUpdates, will return an object with the url field empty.
 * 
 * @method false|PromiseInterface|true                 close()                                                 Use this method to close the bot instance before moving it from one local server to another. You need to delete the webhook before calling this method to ensure that the bot isn't launched again after server restart. The method will return error 429 in the first 10 minutes after the bot is launched. Returns True on success. Requires no parameters.
 * @method false|PromiseInterface|true                 logOut()                                                Use this method to log out from the cloud Bot API server before launching the bot locally. You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes. Returns True on success. Requires no parameters.
 * @method false|PromiseInterface|MessageId            copyMessage(array $parameters = [])                                                Use this method to log out from the cloud Bot API server before launching the bot locally. You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes. Returns True on success. Requires no parameters.
 * @method false|PromiseInterface|true                 unpinAllChatMessages(array $parameters = [])            Use this method to clear the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in a supergroup or 'can_edit_messages' admin right in a channel. Returns True on success.
 * 
 * @method false|PromiseInterface|ChatInviteLink       createChatInviteLink(array $parameters = [])            Use this method to create an additional invite link for a chat. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. The link can be revoked using the method revokeChatInviteLink. Returns the new invite link as ChatInviteLink object.
 * @method false|PromiseInterface|ChatInviteLink       editChatInviteLink(array $parameters = [])              Use this method to edit a non-primary invite link created by the bot. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns the edited invite link as a ChatInviteLink object.
 * @method false|PromiseInterface|ChatInviteLink       revokeChatInviteLink(array $parameters = [])            Use this method to revoke an invite link created by the bot. If the primary link is revoked, a new link is automatically generated. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns the revoked invite link as ChatInviteLink object.
 * 
 * @method true|PromiseInterface       approveChatJoinRequest(array $parameters = [])            Use this method to approve a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right. Returns True on success.
 * @method true|PromiseInterface       declineChatJoinRequest(array $parameters = [])            Use this method to decline a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right. Returns True on success.
 * 
 * @method true|PromiseInterface       banChatSenderChat(array $parameters = [])                Use this method to ban a channel chat in a supergroup or a channel. Until the chat is unbanned, the owner of the banned chat won't be able to send messages on behalf of any of their channels. The bot must be an administrator in the supergroup or channel for this to work and must have the appropriate administrator rights. Returns True on success.
 * @method true|PromiseInterface       unbanChatSenderChat(array $parameters = [])              Use this method to unban a previously banned channel chat in a supergroup or channel. The bot must be an administrator for this to work and must have the appropriate administrator rights. Returns True on success.
 * 
 * @method TeleBot              async(bool $async = true)                                       Call next method asynchronously (bot method will return guzzle promise)
 * @method TeleBot              exceptions(bool $exceptions = true)                             Throw exceptions on next method (bot method will throw `TeleBotRequestException` on request error)
 * @method void                 addHandler($handler)                                            Add new update handler(s) to the bot instance
 * @method void                 clearHandlers()                                                 Remove all update handlers from bot instance
 * @method false|Update         handleUpdate(Update $update = null)                             Handle given update
 * @method BotCommand[]         getLocalCommands()                                              Get local bot instance commands registered by commands handlers
 * @method void                 callHandler($handler, Update $update, bool $force = false)      Run update handler.
 * 
 * 
 * @method mixed                getConfig()                                                     Get config that was used to create this bot instance
 * @property string $token Your telegram bot token.
 * @property string $api_url API URL which will be used by library's HTTP client.
 * @property bool $exceptions By default, bot throws TeleBotRequestException on telegram request errors. You may set this parameter false. In this case bot methods will return false instead of throwing exception.
 * @property bool $async If you set this parameter true, bot methods will return Guzzle's A+ `PromiseInterface` object, which you can handle mannualy.
 */
class BotManager
{
    use HasTelegramMethods;

    /**
     * Array of bot instances.
     * @var array
     */
    protected $bots = [];

    /**
     * Default bot name.
     * @var string|null
     */
    protected $default;

    public function __construct(array $config = null)
    {
        $bots = $config['bots'] ?? [];

        if (count($bots) < 1) {
            throw TeleBotObjectException::noBotsSpecified();
        }
        $this->bots = $bots;
        $this->default($config['default'] ?? $this->bots()[0]);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->bot()->{$name}(...($arguments ?? []));
    }

    public function __get(string $name)
    {
        return $this->bot()->$name;
    }

    public function __set(string $name, $value)
    {
        if (!in_array($name, ['token', 'exceptions', 'async', 'api_url'])) {
            throw TeleBotObjectException::inaccessibleVariable($name, self::class);
        }

        return $this->bot()->$name = $value;
    }

    public function __isset(string $key)
    {
        return isset($this->bot()->$key);
    }

    public function __unset(string $key)
    {
        throw TeleBotObjectException::inaccessibleUnsetVariable($key, self::class);
    }

    /**
     * Get bot by name.
     * @param string $name bot name
     * @throws TeleBotObjectException
     * @return TeleBot
     */
    public function bot(string $name = null)
    {
        $bot = $name ?? $this->default ?? null;

        if (is_null($bot)) {
            throw TeleBotObjectException::defaultBotIsNotSet();
        }

        if (!isset($this->bots[$bot])) {
            throw TeleBotObjectException::botNotFound($bot);
        }

        if (!($this->bots[$bot] instanceof TeleBot)) {
            $this->bots[$bot] = new TeleBot($this->bots[$bot]);
        }

        return $this->bots[$bot];
    }

    /**
     * Get array of bot names attached to BotManager instance.
     *
     * @return array
     */
    public function bots()
    {
        return array_keys($this->bots);
    }

    /**
     * Add bot to BotManager.
     * @param string               $name bot name
     * @param array|string|TeleBot $bot  TeleBot instance or bot config
     * @return TeleBot added bot
     */
    public function add(string $name, $bot)
    {
        if ($bot instanceof TeleBot) {
            $this->bots[$name] = $bot;
        } else {
            $this->bots[$name] = new TeleBot($bot);
        }

        return $this->bots[$name];
    }

    /**
     * Delete bot from BotManager.
     * @param string $name bot name
     */
    public function delete(string $name)
    {
        unset($this->bots[$name]);
        if ($this->default == $name) {
            $this->default = null;
        }
    }

    /**
     * Set default bot name.
     * @param string $name bot name
     * @return TeleBot default bot
     */
    public function default(string $name)
    {
        if (isset($this->bots[$name])) {
            $this->default = $name;
        } else {
            throw TeleBotObjectException::botNotFound($name);
        }

        return $this->bots[$name];
    }
}
