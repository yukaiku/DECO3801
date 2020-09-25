using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;
using UnityEngine.UI;

public class IsGameover : MonoBehaviour
{

    public enum TimeoutOptions
    {
        nothing = 0,
        jumpScene = 1,
        showGameOver = 2
    }

    // vars for Timer
    public TimerUtility timer;
    public TimeoutOptions timeoutOptions;

    // vars for GameOverMenu
    public GameObject menuToShow;
    public Transform parent;
    private GameObject newMenu;

    // vars for SceneChange
    [ChoiceList(new[] { "LoadingScene" })]
    public string sceneName;
    private bool trigger = false;
    private Text[] nounTextList;        // namely noun tag list
    private SendingData sender;

    private void isTimerNull()
    {
        if (timer == null)
        {
            IsGameover component = this.gameObject.GetComponent<IsGameover>();
            Destroy(component);

            Debug.Log(string.Format("Null timer assigned and the component won't work"));
        }
        sender = gameObject.AddComponent<SendingData>();
    }

    private void getNounTextList()
    {
        List<Text> nounTagList = new List<Text>();
        foreach (NounTagUtility nounTag in Object.FindObjectsOfType<NounTagUtility>())
        {
            Text tagText = nounTag.gameObject.GetComponent<Text>();
            if (tagText != null)
            {
                nounTagList.Add(tagText);
            }
        }
        nounTextList = nounTagList.ToArray();
        // save the number of total nouns in this level
        DataStorage.setCurrentNounCount(nounTextList.Length);

        Debug.Log(string.Format("In total '{0}' noun text box in this panel'", nounTextList.Length));
    }

    private void isTimeout()
    {
        if (!trigger && timer.timeStart <= 0)
        {
            trigger = true;

            if (trigger)
            {
                // save player time spent
                DataSystem.saveTimeLeft(timer.timeStart);
                // send data to database in server side
                // sender.sendDataByJS();
                sender.sendData();
                // do something when timeout
                doSomething();
            }
        }
    }

    private void doSomething()
    {
        switch (timeoutOptions)
        {
            case TimeoutOptions.nothing:
                doNothing();
                break;
            case TimeoutOptions.jumpScene:
                doJumpScene();
                break;
            case TimeoutOptions.showGameOver:
                doShowGameOver();
                break;
            default:
                break;
        }
    }

    private void doNothing()
    {
        Debug.Log(string.Format("Timeout : Object '{0}' timer",
            this.gameObject.ToString()));
    }

    private void doJumpScene()
    {
        if ((sceneName != null) && (SceneManager.GetSceneByName(sceneName) != null))
        {
            SceneManager.LoadScene(sceneName);
            Debug.Log(string.Format("Timeout : load to '{0}' scene", sceneName));
        }
        else
        {
            Debug.Log(string.Format("Timeout : no such scene name"));
        }
    }

    private void doShowGameOver()
    {
      if (menuToShow != null)
      {
        // CODE-TO-ADD: Making the GameOverMenu spawn in center of screen. (Camera/Screen pos, maybe?)

        newMenu = Instantiate(menuToShow, transform.position, transform.rotation) as GameObject;
        newMenu.transform.SetParent(parent);
        newMenu.transform.position -= Vector3.up * 10.0f;
        Debug.Log(string.Format("Created Menu: '{0}'", newMenu));
      } else {
        Debug.Log(string.Format("Failed to create Menu"));
      }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        isTimerNull();
        getNounTextList();
    }

    // Update is called once per frame
    void Update()
    {
        isTimeout();
    }
}
