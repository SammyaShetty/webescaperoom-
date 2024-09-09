import requests
import urllib.parse
import base64

# Send score to server
story_id = 1  # Replace with the current story ID
level_id = 1  # Replace with the current level ID
player_name = "John Doe"  # Replace with the player's name
score = 100  # Replace with the player's score

args = {
    "story_id": story_id,
    "level_id": level_id,
    "player_name": urllib.parse.quote(base64.b64encode(player_name.encode()).decode()),
    "score": score,
    "hash": 1234
}

response = requests.post("http://localhost/add_score.php", data=args)

if response.status_code == 200:
    print("Score sent successfully!")
else:
    print("Error sending score:", response.text)

# Get scores from server
story_id = 1  # Replace with the current story ID
level_id = 1  # Replace with the current level ID

response = requests.get(f"http://localhost/get_scores.php?story_id={story_id}&level_id={level_id}")

if response.status_code == 200:
    print("Scores retrieved successfully!")
    print(response.json())  # Assuming the server returns JSON data
else:
    print("Error retrieving scores:", response.text)