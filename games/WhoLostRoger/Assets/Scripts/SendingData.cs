using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;
using System.Runtime.InteropServices;

// it will send data when a level is completed or gameover
public class SendingData : MonoBehaviour
{
    [DllImport("__Internal")]
    private static extern void sendDataJS(string url, string fields);

    private string url = "http://localhost/games/GameExecutables/WhoLostRoger/saveData.php";

    private int getTotalScore()
    {
        int totalScore = DataSystem.calculateTotalScore(Mathf.RoundToInt(DataStorage.getTimeLeft()), 
                DataStorage.getScorePoint(), DataStorage.getTimePerScore());
        return totalScore;
    }

    private int getPercentage()
    {
        int percentage = DataSystem.calculateNounPercentage(DataStorage.getCurrentNounCount(), DataStorage.getScorePoint(), 
                DataStorage.getScorePerNoun());
        return percentage;
    }

    public void sendData()
    {
        int totalScore = getTotalScore();
        int percentage = getPercentage();

        WWWForm formData = new WWWForm();
        formData.AddField("game_id", DataStorage.getGameId());
        formData.AddField("player_id", DataStorage.getPlayerId());
        formData.AddField("current_level", DataStorage.getCurrentLevel());
        formData.AddField("score", totalScore);
        formData.AddField("noun_percentage", percentage);

        StartCoroutine(sendRequest(this.url, formData));
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

    public void saveDataFromJS()
    {
        int totalScore = getTotalScore();
        int percentage = getPercentage();

        string fields = "game_id=" + DataStorage.getGameId() + "&player_id=" + DataStorage.getPlayerId() + "&current_level="
                + DataStorage.getCurrentLevel() + "&score=" + totalScore + "&noun_percentage=" + percentage.ToString();

        sendDataJS(this.url, fields);
    }
}
