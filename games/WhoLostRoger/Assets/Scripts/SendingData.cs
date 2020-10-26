using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;
using System.Runtime.InteropServices;

/*
 * This component script is used for sending game data to the server 
 * while a level is completed or game over by a player.
 * 
 */
public class SendingData : MonoBehaviour
{
    [DllImport("__Internal")]
    private static extern void sendDataJS(string url, string fields);

    private string urlLink = "https://deco3801-cats.uqcloud.net/games/GameExecutables/WhoLostRoger/saveData.php";

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
        formData.AddField("final_score", totalScore);
        formData.AddField("noun_percentage", percentage);
        formData.AddField("time_used", Mathf.RoundToInt(DataStorage.getTimeUsed()));
        formData.AddField("nouns_clicked", DataStorage.getNounsClicked());

        StartCoroutine(sendRequest(this.urlLink, formData));
    }

    IEnumerator sendRequest(string urlLink, WWWForm formData)
    {
        UnityWebRequest www = UnityWebRequest.Post(urlLink, formData);
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

    public void sendDataByJS()
    {
        int totalScore = getTotalScore();
        int percentage = getPercentage();

        string fields = "game_id=" + DataStorage.getGameId() + "&player_id=" + DataStorage.getPlayerId() + "&current_level="
                + DataStorage.getCurrentLevel() + "&score=" + totalScore + "&noun_percentage=" + percentage.ToString();

        sendDataJS(this.urlLink, fields);
    }
}
