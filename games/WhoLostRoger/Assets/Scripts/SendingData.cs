using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;

public class SendingData : MonoBehaviour
{
    // it will send data when a level is completed or gameover
    public void sendData(int totalNounCount)
    {
        string url = "https://localhost/games/GameExecutables/WhoLostRoger/saveData.php";

        WWWForm formData = new WWWForm();
        int totalScore = DataSystem.calculateTotalScore(Mathf.RoundToInt(DataStorage.getTimeLeft()), DataStorage.getScorePoint(), 5);
        int percentage = DataSystem.calculateNounPercentage(totalNounCount, DataStorage.getScorePoint(), 1);

        formData.AddField("game_id", DataStorage.getGameId());
        formData.AddField("player_id", DataStorage.getPlayerId());
        formData.AddField("current_level", DataStorage.getCurrentLevel());
        formData.AddField("score", totalScore);
        formData.AddField("noun_percentage", percentage);

        StartCoroutine(sendRequest(url, formData));
    }

    IEnumerator sendRequest(string url, WWWForm formData)
    {
        UnityWebRequest www = UnityWebRequest.Post(url, formData);
        yield return www.SendWebRequest();

        if (www.isNetworkError || www.isHttpError)
        {
            Debug.Log(www.error);
        }
        else
        {
            Debug.Log("Form upload complete!");
        }
    }

    // Start is called before the first frame update
    void Start()
    {
        
    }

}
