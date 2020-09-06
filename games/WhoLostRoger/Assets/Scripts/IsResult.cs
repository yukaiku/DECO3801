using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.SceneManagement;

public class IsResult : MonoBehaviour
{
    public enum Options
    {
        nothing = 0,
        jumpScene = 1,
    }

    [Tooltip("the panel contains nouns text")]
    public GameObject nounPanel;
    public TimerUtility timer;
    public Options options;
    [ChoiceList(new[] { "ResultScene" })]
    public string sceneName;

    public Text[] nounTextList;
    private bool trigger = false;

    private void isArgsNull()
    {
        if (nounPanel == null || timer == null)
        {
            IsResult component = this.gameObject.GetComponent<IsResult>();
            Destroy(component);

            Debug.Log(string.Format("Null arguments assigned and the component won't work"));
        }
    }

    private void getNounTextList()
    {
        nounTextList = nounPanel.GetComponentsInChildren<Text>(true);
        Debug.Log(string.Format("In total '{0}' noun text box in this panel'", nounTextList.Length));
    }

    // trigger this event when a noun object is clicked
    public void isAllNounClicked()
    {
        if (!trigger)
        {
            int count = 0;
            for (int i = 0; i < nounTextList.Length; ++i)
            {
                if (!nounTextList[i].gameObject.activeSelf)
                {
                    count++;
                }

                if (count == nounTextList.Length)
                {
                    trigger = true;
                    Debug.Log(string.Format("All nouns clicked."));
                }
            }

            if (trigger)
            {
                // save player time spent
                DataSystem.saveTimeLeft(timer.timeStart);
                // do something when triggered
                doSomething();
            }
        }
    }

    private void doSomething()
    {
        switch (options)
        {
            case Options.nothing:
                doNothing();
                break;
            case Options.jumpScene:
                doJumpScene();
                break;
            default:
                break;
        }
    }

    private void doNothing()
    {
        Debug.Log(string.Format("Do nothing when all nouns clicked",
            this.gameObject.ToString()));
    }

    private void doJumpScene()
    {
        if ((sceneName != null) && (SceneManager.GetSceneByName(sceneName) != null))
        {
            SceneManager.LoadScene(sceneName);
            Debug.Log(string.Format("Load to '{0}' scene", sceneName));
        }
        else
        {
            Debug.Log(string.Format("No such scene name"));
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        isArgsNull();
        getNounTextList();
    }

    // Update is called once per frame
    void Update()
    {

    }
}
