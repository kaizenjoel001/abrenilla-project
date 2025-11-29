<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Chatbot extends Controller
{
    public function respond()
    {
        $request = $this->request->getJSON();
        $userMessage = $request->message ?? '';

        if (!$userMessage) {
            return $this->response->setJSON(['reply' => 'No message received.']);
        }

        // Load session and initialize conversation history
        $session = session();
        if (!$session->has('chat_history')) {
            $session->set('chat_history', [
                ['role' => 'system', 'content' => 'You are an intelligent and friendly assistant for SK officials, providing suggestions on youth programs, events, and community development.']
            ]);
        }

        // Append user message to history
        $history = $session->get('chat_history');
        $history[] = ['role' => 'user', 'content' => $userMessage];

        // Load OpenAI API key from .env
        $apiKey = getenv('OPENAI_API_KEY');
        if (!$apiKey) {
            return $this->response->setJSON(['reply' => 'API key not loaded from .env']);
        }

        // Build API request data
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => $history
        ];

        // Make the API call using cURL
        $ch = curl_init('https://api.openai.com/v1/chat/completions');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey
            ],
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_SSL_VERIFYPEER => true, // Change to false only for debugging SSL issues
        ]);

        $result = curl_exec($ch);

        // Handle cURL error
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return $this->response->setJSON([
                'reply' => 'Failed to connect to OpenAI: ' . $error
            ]);
        }

        curl_close($ch);
        $response = json_decode($result, true);

        // Handle invalid OpenAI response
        if (!isset($response['choices'][0]['message']['content'])) {
            log_message('error', 'OpenAI response error: ' . print_r($response, true));

            if (isset($response['error']['message'])) {
                return $this->response->setJSON([
                    'reply' => 'OpenAI Error: ' . $response['error']['message']
                ]);
            }

            return $this->response->setJSON([
                'reply' => 'OpenAI returned unexpected response.',
                'raw_response' => $response
            ]);
        }

        // Extract assistant reply and update session history
        $reply = $response['choices'][0]['message']['content'];
        $history[] = ['role' => 'assistant', 'content' => $reply];
        $session->set('chat_history', $history);

        return $this->response->setJSON(['reply' => $reply]);
    }
}
