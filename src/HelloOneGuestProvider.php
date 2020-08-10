<?php

namespace HelloOne\Laravel\Socialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class HelloOneGuestProvider extends AbstractProvider implements ProviderInterface {


    const SCOPE_ACCOUNT_READ = 'account:read';

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl() {
        return config( 'hello-one-socialite.project_url' ) .
               '/oauth/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields( $code ) {
        return \Arr::add(
            parent::getTokenFields( $code ), 'grant_type', 'authorization_code'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl( $state ) {
        return $this->buildAuthUrlFromBase(
            rtrim(config( 'hello-one-socialite.project_url' ), '/').
            '/oauth/authorize',
            $state );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken( $token ) {
        $response = $this->getHttpClient()->get(
            config( 'hello-one-socialite.project_url' ) . '/api/oauth/me',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]
        );

        return json_decode( $response->getBody(), true );
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject( array $user ) {
        $userData = $user['data'];
        return ( new User )->setRaw( $user )->map( [
            'id'       => $userData['id'],
            'project_id' => $userData['project_id'],
            'email' => $userData['email'],
            'salutation' => $userData['salutation'],
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'company' => $userData['company'],
            'phone' => $userData['phone'],
            'mobile_phone' => $userData['mobile_phone'],
            'street' => $userData['street'],
            'house_number' => $userData['house_number'],
            'zip' => $userData['zip'],
            'city' => $userData['city'],
            'country' => $userData['country'],
            'email_verified_at' => $userData['email_verified_at'],
            'audience_ids' => $userData['audience_ids'],
            'audiences' => $userData['audiences'],
            'event_ids' => (array_key_exists('event_ids', $userData) ? $userData['event_ids'] : null),
            'events' => (array_key_exists('events', $userData) ? $userData['events'] : null),
            'profile_image_uuid' => $userData['profile_image_uuid'],
            'profile_image_url' => $userData['profile_image_url'],] );
    }

}
