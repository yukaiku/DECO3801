using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;

public class SendingData : MonoBehaviour
{

    public void sendData()
    {
        string url = "http://localhost/cats/games/wholostroger/saveData.php";

        WWWForm formData = new WWWForm();
        formData.AddField("game_id", DataStorage.getGameId());
        formData.AddField("player_id", DataStorage.getPlayerId());
        formData.AddField("current_level", DataStorage.getCurrentLevel());
        formData.AddField("score_point", DataStorage.getScorePoint());

        UnityWebRequest www = UnityWebRequest.Post(url, formData);
        StartCoroutine(sendRequest(www));
    }

    IEnumerator sendRequest(UnityWebRequest www)
    {
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
