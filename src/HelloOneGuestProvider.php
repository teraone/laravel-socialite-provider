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
        return array_add(
            parent::getTokenFields( $code ), 'grant_type', 'authorization_code'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl( $state ) {
        return $this->buildAuthUrlFromBase(
            config( 'hello-one-socialite.project_url' ) .
            '/oauth/authorize',
            $state );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken( $token ) {
        $response = $this->getHttpClient()->get(
            config( 'hello-one-socialite.project_url' ) . '/oauth/me',
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
        return ( new User )->setRaw( $user )->map( [
            'id'       => $user['id'],
            'nickname' => $user['first_name'] . ' ' . $user['last_name'],
            'name'     => $user['first_name'] . ' ' . $user['last_name'],
            'avatar'   => ! empty( $user['profile_image_url'] ) ? $user['profile_image_url'] : null,
        ] );
    }

}
